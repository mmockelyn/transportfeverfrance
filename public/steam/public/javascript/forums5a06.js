
function Forum_CreateTopic( pageid )
{
	if ( g_rgForums[pageid] )
		g_rgForums[pageid].DisplayNewTopicForm();
}

function Forum_Subscribe( pageid )
{
	if ( g_rgForums[pageid] )
		g_rgForums[pageid].SubscribeToForum();
}

function Forum_Unsubscribe( pageid )
{
	if ( g_rgForums[pageid] )
		g_rgForums[pageid].UnsubscribeFromForum();
}

function Forum_SetTopicsPerPage( cTopicsPerPage )
{
	new Ajax.Request( 'https://steamcommunity.com/forum/0/0/setpreference', {
		parameters: {preference: 'topicsperpage', value: cTopicsPerPage, sessionid: g_sessionID },
		onComplete: function() { window.location.reload() }
	} );
}

function Forum_SetTopicRepliesPerPage( cTopicRepliesPerPage )
{
	new Ajax.Request( 'https://steamcommunity.com/forum/0/0/setpreference', {
		parameters: {preference: 'topicrepliesperpage', value: cTopicRepliesPerPage, sessionid: g_sessionID },
		onComplete: function() { window.location.reload() }
	} );
}

function Forum_CancelEvent( event )
{
	if ( !event )
		event = window.event;

	if ( event.stopPropagation )
		event.stopPropagation();
	else
		event.cancelBubble = true;
}

function Forum_InitTooltips()
{
	// Override default tooltips for forums
	$J('.forum_topic[data-tooltip-forum], .forum_topic_link[data-tooltip-forum]').v_tooltip( {
		'location':'bottom',
		trackMouse: true,
		'tooltipClass': 'forum_topic_tooltip',
		offsetY: 6,
		fadeSpeed: 0,
		trackMouseCentered: false,
		disableOnTouchDevice: true,
		defaultType: 'html',
		dataName: 'tooltipForum'
	});

}

function Forum_InitPostAndCommentControls( container )
{
	if ( container )
	{
		$J( container ).find('.forum_comment_action_trigger').v_tooltip({'location':'bottom', 'destroyWhenDone': false, 'tooltipClass': 'forum_comment_action_menu', 'offsetY':0, 'offsetX': 1, 'horizontalSnap': 4, /*'tooltipParent': '#global_header .supernav_container',*/ 'correctForScreenSize': true});
	}
	else
	{
		$J('.forum_comment_action_trigger').v_tooltip({'location':'bottom', 'destroyWhenDone': false, 'tooltipClass': 'forum_comment_action_menu', 'offsetY':0, 'offsetX': 1, 'horizontalSnap': 4, /*'tooltipParent': '#global_header .supernav_container',*/ 'correctForScreenSize': true});
	}
}

var g_rgForums = {};
function InitializeForum( name, rgForumData, url )
{
	g_rgForums[ name ] = new CForum( name, rgForumData, url );
}

var CForum = Class.create( {

	m_strName: null,
	m_rgForumData: null,
	m_strActionURL: null,
	m_cPageSize: null,

	m_cTotalCount: 0,
	m_iCurrentPage: 0,
	m_iInitialPage: 0,
	m_cMaxPages: 0,
	m_bLoading: false,
	m_bSubmittingTopic: false,
	m_bNewTopicFormDisplayed: false,
	m_rgCreateTopicFlags: null,


	initialize: function( name, rgForumData, url )
	{
		this.m_strName = name;
		this.m_rgForumData = rgForumData;
		this.m_strActionURL = url;

		this.m_cTotalCount = rgForumData['total_count'];
		this.m_cPageSize = rgForumData['pagesize'];
		this.m_iCurrentPage = this.m_iInitialPage = Math.floor( ( rgForumData.start || 0 ) / this.m_cPageSize );
		this.m_cMaxPages = Math.ceil( this.m_cTotalCount / this.m_cPageSize );

		var strPrefix = 'forum_' + this.m_strName;

		var elForm = $( strPrefix + '_newtopic_form' );
		if ( elForm )
		{
			elForm.observe( 'submit', this.NewTopic.bind( this ) );
		}

		this.m_elTextArea = $( strPrefix + '_textarea');

		if ( this.m_elTextArea )
		{
			new CAutoSizingTextArea( this.m_elTextArea, 40, this.OnTextInput.bind(this) );
		}

		BindOnHashChange( this.OnLocationChange.bind(this) );
		this.OnLocationChange( window.location.hash );

		var _this = this;
		if ( window.history && window.history.pushState )
		{
			window.history.replaceState( {forum_page: this.m_iCurrentPage }, '' );

			$J(window).on('popstate', function( e ) {
				var oState = e.originalEvent.state;

				if ( oState && typeof oState.forum_page != 'undefined' )
					_this.GoToPage( oState.forum_page, false, true );
			});
		}


		$(strPrefix + '_pagebtn_prev').observe( 'click', this.OnPagingButtonClick.bindAsEventListener( this , this.PrevPage ) );
		$(strPrefix + '_footerpagebtn_prev') && $(strPrefix + '_footerpagebtn_prev').observe( 'click', this.OnPagingButtonClick.bindAsEventListener( this , this.PrevPage ) );
		$(strPrefix + '_pagebtn_next').observe( 'click', this.OnPagingButtonClick.bindAsEventListener( this , this.NextPage ) );
		$(strPrefix + '_footerpagebtn_next') && $(strPrefix + '_footerpagebtn_next').observe( 'click', this.OnPagingButtonClick.bindAsEventListener( this , this.NextPage ) );

		Forum_InitTooltips();
		this.UpdatePagingDisplay();
	},

	DisplayNewTopicForm: function()
	{
		if ( !this.m_bNewTopicFormDisplayed )
		{
			if( !$('forum_' + this.m_strName + '_newtopic_area').visible() )
				new Effect.BlindDown( 'forum_' + this.m_strName + '_newtopic_area', { duration: 0.25 } );

			var $Form = $J('#forum_' + this.m_strName + '_newtopic_form');

			if ( $Form.length )
			{
				var _this = this;
				$Form.find( '[name=subforum]' ).change( function() { _this.UpdateCreateTopicFormDisplay(); } );

				if ( !this.m_rgCreateTopicFlags )
				{
					new Ajax.Request( this.GetActionURL( 'getcreatetopicflags' ), {
						method: 'get',
						onSuccess: function( transport ) { _this.m_rgCreateTopicFlags = transport.responseJSON || {}; _this.UpdateCreateTopicFormDisplay(); },
						onFailure: function( transport ) { _this.m_rgCreateTopicFlags = {}; _this.UpdateCreateTopicFormDisplay(); }
					});
				}
			}

			this.m_bNewTopicFormDisplayed = true;
		}
	},

	UpdateCreateTopicFormDisplay: function()
	{
		var strForumType = this.m_rgForumData.type;

		var elForm = $('forum_' + this.m_strName + '_newtopic_form');
		var elSubforumSelect = elForm.elements['subforum'];
		if ( elSubforumSelect )
		{
			// see if they've selected a different type
			if ( elSubforumSelect.length )
			{
				// radio buttons
				for ( var i=0; i < elSubforumSelect.length; i++ )
				{
					if ( elSubforumSelect[i].checked )
					{
						strForumType = elSubforumSelect[i].value.replace( /_.*$/, '' );
						break;
					}
				}
			}
			else if ( elSubforumSelect.value )
			{
				strForumType = elSubforumSelect.value.replace( /_.*$/, '' );
			}
		}

		var elInfoMessage = $('forum_' + this.m_strName + '_newtopic_info' );
		if ( this.m_rgCreateTopicFlags !== null && strForumType == 'Trading' )
		{
			var strMessage = 'N???u kho ????? c???a b???n ??? ch??? ????? c??ng khai, m???i th??nh vi??n kh??c s??? c?? th??? g???i cho b???n ????? ngh??? trao ?????i ??? ch??? ????? n??y.';
			if ( this.m_rgCreateTopicFlags.inventory_public )
				strMessage = '<b>Kho ????? c???a b???n ???????c ?????t ??? ch??? ????? c??ng khai</b>. ??i???u n??y c?? ngh??a l?? c??c th??nh vi??n trong c???ng ?????ng ???????c g???i ????? ngh??? trao ?????i t???i b???n t??? ch??? ????? n??y. N???u b???n thi???t l???p ch??? ????? ri??ng t?? cho r????ng c???a m??nh kh??c v???i ch??? ????? c??ng khai, th?? b???n s??? kh??ng nh???n ???????c c??c ????? ngh??? trao ?????i t??? c???ng ?????ng.';
			else if ( typeof this.m_rgCreateTopicFlags.inventory_public != 'undefined' )
				strMessage = '<b>Kho ????? c???a b???n <u>kh??ng</u> ??? ch??? ????? c??ng khai</b>. ??i???u n??y c?? ngh??a l?? c??c th??nh vi??n trong c???ng ?????ng s??? kh??ng th??? g???i ????? ngh??? trao ?????i t???i b???n t??? ch??? ????? n??y. N???u b???n chuy???n thi???t l???p r????ng c???a m??nh sang ch??? ????? c??ng khai, c??c th??nh vi??n trong c???ng ?????ng s??? c?? th??? g???i ????? ngh??? trao ?????i t???i b???n t??? ch??? ????? n??y.';

			strMessage += '<div class="forum_newtopic_info_rule"></div>';
			strMessage += '<img class="forum_newtopic_info_trade_closebuttondemo" src="https://community.akamai.steamstatic.com/public/images/skin_1/forum_img_closetopic.png">';
			strMessage += 'Khi b???n k???t th??c qu?? tr??nh nh???n ????? ngh??? trao ?????i ho???c ???? trao ?????i xong, b???n c?? th??? ????ng v???n ????? n??y ho???c c???m trao ?????i n???a.';
			strMessage += '<div style="clear: both;"></div>';

			elInfoMessage.update( strMessage );

			elInfoMessage.show();
		}
		else
		{
			elInfoMessage.hide();
		}
	},

	OnTextInput: function( elTextArea )
	{
	},

	NewTopic: function()
	{
		if ( this.m_bSubmittingTopic )
			return false;

		var form = $('forum_' + this.m_strName + '_newtopic_form' );
		if ( form.elements['topic'].value.length > 0 && form.elements['text'].value.length > 0 )
		{
			this.m_bSubmittingTopic = true;
			$('forum_' + this.m_strName + '_newtopic_error' ).hide();
			$('forum_' + this.m_strName + '_submit_container').hide();
			$('forum_' + this.m_strName + '_submit_throbber_container').show();

			var strName = this.m_strName;

			new Ajax.Request( this.GetActionURL( 'createtopic' ), {
					method: 'post',
					parameters: form.serialize(),
					onSuccess: this.OnNewTopicSuccess.bind( this ),
					onFailure: this.OnNewTopicFailure.bind( this )
			} );
		}

		return false;
	},

	OnNewTopicSuccess: function( transport )
	{
		this.m_bSubmittingTopic = false;
		var rgJSON = transport.responseJSON || {};

		if ( rgJSON.topic_url )
		{
			window.location = rgJSON.topic_url;
		}
	},

	OnNewTopicFailure: function( transport )
	{
		this.m_bSubmittingTopic = false;
		var rgJSON = transport.responseJSON || {};
		$('forum_' + this.m_strName + '_newtopic_error' ).update( '???? c?? l???i x???y ra khi t???o m???t ch??? ????? m???i: ' + ( rgJSON.error ? rgJSON.error : rgJSON.success ) );
		new Effect.Appear( $('forum_' + this.m_strName + '_newtopic_error' ), { duration: 0.5 } );

		$('forum_' + this.m_strName + '_submit_container').show();
		$('forum_' + this.m_strName + '_submit_throbber_container').hide();
	},

	GetActionURL: function( action )
	{
		var url = this.m_strActionURL + action + '/';
		if ( this.m_rgForumData['feature'] )
			url += this.m_rgForumData['feature'] + '/';
		return url;
	},

	OnAJAXComplete: function()
	{
		this.m_bLoading = false;
	},

	OnLocationChange: function( hash )
	{
		if ( hash.match( /^#p[0-9]+$/ ) )
		{
			var iPage = parseInt( hash.substring(2) ) - 1;
			if ( this.m_iCurrentPage != iPage )
				this.GoToPage( iPage );
		}
		else if ( !hash )
		{
			// reset to initial view
			this.GoToPage( this.m_iInitialPage );
		}
	},

	OnPagingButtonClick: function( event, fnToExecute )
	{
		event.stop();
		fnToExecute.call( this );
	},

	NextPage: function()
	{
		if ( this.m_iCurrentPage < this.m_cMaxPages - 1 )
			this.GoToPage( this.m_iCurrentPage + 1 );
	},

	PrevPage: function()
	{
		if ( this.m_iCurrentPage > 0 )
			this.GoToPage( this.m_iCurrentPage - 1 );
	},

	ReloadCurrentPage: function()
	{
		this.GoToPage( this.m_iCurrentPage, true /* force */ );
	},

	m_nAjaxSequenceNumber: 0,
	GoToPage: function( iPage, bForce )
	{
		if ( iPage >= this.m_cMaxPages || iPage < 0 || ( iPage == this.m_iCurrentPage && !bForce ) )
			return;

		var params = {
			start: this.m_cPageSize * iPage,
			count: this.m_cPageSize
		};
		if ( this.m_rgForumData['extended_data'] )
			params['extended_data'] = this.m_rgForumData['extended_data'];

		this.m_bLoading = true;
		new Ajax.Request( this.GetActionURL( 'render' ), {
			method: 'get',
			parameters: params,
			onSuccess: this.OnResponseRenderTopics.bind( this, ++this.m_nAjaxSequenceNumber ),
			onComplete: this.OnAJAXComplete.bind( this )
		});
	},

	OnResponseRenderTopics: function( nSequenceNumber, transport )
	{
		if ( nSequenceNumber != this.m_nAjaxSequenceNumber )
		{
			return;
		}

		if ( transport.responseJSON )
		{
			var response = transport.responseJSON;
			this.m_cTotalCount = response.total_count;
			this.m_cMaxPages = Math.ceil( response.total_count / this.m_cPageSize );
			this.m_iCurrentPage = Math.floor( response.start / this.m_cPageSize );

			if ( this.m_cTotalCount <= response.start )
			{
				// this page is no logner valid, flip back a page (deferred so that the AJAX handler exits and reset m_bLoading)
				this.GoToPage.bind( this, this.m_iCurrentPage - 1 ).defer();
				return;
			}

			var elTopics = $('forum_' + this.m_strName + '_topics' );
			var elContainer = $('forum_' + this.m_strName + '_topiccontainer' );

			elTopics.update( response.topics_html );


			if ( window.history && window.history.pushState )
			{
				var params = window.location.search.length ? $J.deparam( window.location.search.substr(1) ) : {};
				var urlpage = params['fp'] ? params['fp'] - 1 : 0;
				if ( urlpage != this.m_iCurrentPage )
				{
					window.history.pushState( { forum_page: this.m_iCurrentPage }, '', UpdateParameterInCurrentURL( 'fp', this.m_iCurrentPage == 0 ? null : this.m_iCurrentPage + 1 ) );
				}
			}
			else if ( this.m_iCurrentPage != this.m_iInitialPage || window.location.hash.length > 1)
			{
				if ( this.m_iCurrentPage != this.m_iInitialPage )
					window.location.hash = 'p' + ( this.m_iCurrentPage + 1);
				else
					window.location.hash = '';
			}

			ScrollToIfNotInView($('forum_' + this.m_strName + '_area' ), 40 );

			this.UpdatePagingDisplay();
			Forum_InitTooltips();
		}
	},

	UpdatePagingDisplay: function()
	{
		var strPrefix = 'forum_' + this.m_strName;


		var rgPagingControls = [ strPrefix + '_page' , strPrefix + '_footerpage' ];
		for ( var i = 0; i < rgPagingControls.length; i++ )
		{
			var strPagePrefix = rgPagingControls[i];

			// we may not always show both sets of controls
			if ( !$(strPagePrefix + 'controls' ) )
				continue;

			$(strPagePrefix + 'total').update( v_numberformat( this.m_cTotalCount ) );
			$(strPagePrefix + 'start').update( v_numberformat( this.m_iCurrentPage * this.m_cPageSize + 1 ) );
			$(strPagePrefix + 'end').update( Math.min( ( this.m_iCurrentPage + 1 ) * this.m_cPageSize, this.m_cTotalCount ) );


			if ( this.m_cMaxPages <= 1 )
			{
				$(strPagePrefix + 'controls').hide();
			}
			else
			{
				$(strPagePrefix + 'controls').show();
				if ( this.m_iCurrentPage > 0 )
					$(strPagePrefix + 'btn_prev').removeClassName('disabled');
				else
					$(strPagePrefix + 'btn_prev').addClassName('disabled');

				if ( this.m_iCurrentPage < this.m_cMaxPages - 1 )
					$(strPagePrefix + 'btn_next').removeClassName('disabled');
				else
				{
					$(strPagePrefix + 'btn_next').addClassName('disabled');
					$J('#' + strPrefix + '_searchformore').show();
				}

				var elPageLinks = $(strPagePrefix + 'links');
				elPageLinks.update('');
				// we always show first, last, + 3 page links closest to current page
				var cPageLinksAheadBehind = 2;
				var firstPageLink = Math.max( this.m_iCurrentPage - cPageLinksAheadBehind, 1 );
				var lastPageLink = Math.min( this.m_iCurrentPage + (cPageLinksAheadBehind*2) + ( firstPageLink - this.m_iCurrentPage ), this.m_cMaxPages - 2 );

				if ( lastPageLink - this.m_iCurrentPage < cPageLinksAheadBehind )
					firstPageLink = Math.max( this.m_iCurrentPage - (cPageLinksAheadBehind*2) + ( lastPageLink - this.m_iCurrentPage ), 1 );

				this.AddPageLink( elPageLinks, 0 );
				if ( firstPageLink != 1 )
					elPageLinks.insert( ' ... ' );

				for ( var iPage = firstPageLink; iPage <= lastPageLink; iPage++ )
				{
					this.AddPageLink( elPageLinks, iPage );
				}

				if ( lastPageLink != this.m_cMaxPages - 2 )
					elPageLinks.insert( ' ... ' );
				this.AddPageLink( elPageLinks, this.m_cMaxPages - 1 );
			}
		}
	},

	AddPageLink: function( elPageLinks, iPage )
	{
		var el = new Element( 'a', {'class': 'forum_paging_pagelink', 'href': UpdateParameterInCurrentURL( 'fp', iPage ? iPage + 1 : null ) } );
		el.update( (iPage + 1) + ' ' );

		var fnGoToPage = this.GoToPage.bind( this, iPage );

		if ( iPage == this.m_iCurrentPage )
			el.addClassName( 'active' );
		else
			$J(el).on('click', function(e) { e.preventDefault(); fnGoToPage();  });

		elPageLinks.insert( el );
	},

	SubscribeToForum: function()
	{
		var strPrefix = 'forum_' + this.m_strName;
		this.m_bLoading = true;
		new Ajax.Request( this.GetActionURL( 'subscribe' ), {
			method: 'POST',
			parameters: {sessionid: g_sessionID},
			onSuccess: function() { $(strPrefix + '_subscribe').hide(); $(strPrefix + '_unsubscribe').show(); },
			onFailure: function() { ShowForumSuccessDialogWithDetailTitle( '????ng k?? di???n ????n', '???? c?? l???i x???y ra khi ????ng k?? theo d??i di???n ????n n??y.', 'Xin vui l??ng th??? l???i sau.' ); },
			onComplete: this.OnAJAXComplete.bind( this )
		});
	},

	UnsubscribeFromForum: function()
	{
		var strPrefix = 'forum_' + this.m_strName;
		this.m_bLoading = true;
		new Ajax.Request( this.GetActionURL( 'unsubscribe' ), {
			method: 'POST',
			parameters: {sessionid: g_sessionID},
			onSuccess: function() { $(strPrefix + '_unsubscribe').hide(); $(strPrefix + '_subscribe').show(); },
			onFailure: function() { ShowForumSuccessDialogWithDetailTitle( 'H???y ????ng k?? di???n ????n', '???? c?? l???i x???y ra khi h???y theo d??i di???n ????n n??y.', 'Xin vui l??ng th??? l???i sau.' ); },
			onComplete: this.OnAJAXComplete.bind( this )
		});
	}

} );

var g_rgForumTopics = {};
var g_rgForumTopicCommentThreads = {};
function InitializeForumTopic( rgForumData, url, gidTopic, rgRawData )
{
	g_rgForumTopics[ gidTopic ] = new CForumTopic( rgForumData, url, gidTopic, rgRawData );
}

function RegisterForumTopicCommentThread( gidTopic, CommentThread )
{
	g_rgForumTopicCommentThreads[ gidTopic ] = CommentThread;
}

function Forum_DeleteTopic( gidTopic )
{
	if ( g_rgForumTopics[ gidTopic ] )
	{
		var Topic = g_rgForumTopics[ gidTopic ];
		if ( Topic.BCheckPermission( 'can_moderate' ) )
		{
			Topic.Delete();
		}
		else
		{
			ShowConfirmDialog('X??a ch??? ????? ',
				'B???n c?? th???t s??? mu???n x??a ch??? ????? n??y? ' +
				'H??nh ?????ng n??y ch??? c?? th??? ???????c kh??i ph???c l???i b???i m???t ng?????i ??i???u h??nh.',
				'X??a ch??? ?????'
			).done( function() {
					Topic.Delete();
				});
		}
	}
}

function Forum_PurgeTopic( gidTopic )
{
	ShowConfirmDialog('X??a v??nh vi???n ',
		'B???n c?? ch???c mu???n x??a ch??? ????? n??y v??nh vi???n? H??nh ?????ng n??y kh??ng th??? ho??n t??c ???????c.',
		'X??a v??nh vi???n'
	).done( function() {
		Forum_SetTopicFlag( gidTopic, 'purge', true );
	});
}


function Forum_ClearContentCheckResult( gidTopic )
{
	ShowConfirmDialog('G??? b??? ????nh ?????u n???i dung c?? th??? b??? c???m ',
		'B???n c?? ch???c mu???n g??? b??? ????nh d???u n???i dung c?? th??? b??? c???m cho ch??? ????? n??y? Vi???c n??y kh??ng th??? ho??n t??c.',
		'G??? b??? ????nh ?????u n???i dung c?? th??? b??? c???m'
	).done( function() {
		Forum_SetTopicFlag( gidTopic, 'clearcontentcheckresult', true );
	});
}

function Forum_BanCommenters( gidTopic )
{
	ShowConfirmDialog('C???m ng?????i b??nh lu???n ',
	'B???n c?? ch???c m??nh mu???n c???m nh???ng ng?????i d??ng ???? b??nh lu???n qu?? 5 l???n trong ch??? ????? n??y? H??nh ?????ng n??y s??? r???t kh?? ho??n t??c.',
	'C???m ng?????i b??nh lu???n'
).done( function() {
	Forum_SetTopicFlag( gidTopic, 'bancommenters', true );
});
}

function Forum_MarkSpam( gidTopic )
{
	ShowConfirmDialog('????nh d???u spam ',
		'H??nh ?????ng n??y s??? x??a c??c ch??? ????? ???? ch???n v?? c???m t??c gi??? kh???i di???n ????n. B???n c?? ch???c mu???n th???c hi???n?',
		'X??a spam'
	).done( function() {
		Forum_SetTopicFlag( gidTopic, 'markspam', true );
	});
}

function Forum_SetTopicFlag( gidTopic, flag, value )
{
	if ( g_rgForumTopics[ gidTopic ] )
		g_rgForumTopics[ gidTopic ].SetTopicFlag( flag, value );
}

function Forum_ReportPost( gidTopic, author, gidComment )
{
	if ( g_rgForumTopics[ gidTopic ] )
		g_rgForumTopics[ gidTopic ].ReportPost( author, gidComment );
}

function Forum_MoveTopic( gidTopic )
{
	if ( g_rgForumTopics[ gidTopic ] )
		g_rgForumTopics[ gidTopic ].MoveTopic();
}

function Forum_MergeTopic( gidTopic )
{
	if ( g_rgForumTopics[ gidTopic ] )
	{
		var Topic = g_rgForumTopics[ gidTopic ];
		Forum_MergeTopicDialog( Topic.GetActionURL( 'mergetopics' ), Topic.m_rgForumData, [ gidTopic ] )
			.done( function( transport ) {

				// the transport is from prototype
				var strNewURL = Topic.m_rgForumData['forum_url'];
				if ( transport && transport.responseJSON && transport.responseJSON.newtopic )
					strNewURL = transport.responseJSON.newtopic;

				if ( strNewURL )
				{
					ShowConfirmDialog(
						'K???t h???p ch??? ?????',
						'Ch??? ????? ???????c l???a ch???n ???? ???????c s??p nh???p v??o m???t ch??? ????? duy nh???t.',
						'T???i ch??? ????? ???? g???p',
						'Tr??? v??? danh s??ch ch??? ?????'
					).done( function() {
						window.location = strNewURL;
					}).fail( function() {
						window.location = Topic.m_rgForumData['forum_url'];
					});
				}
			});
	}
}

function Forum_SubscribeToTopic( gidTopic )
{
	if ( g_rgForumTopics[ gidTopic ] )
		g_rgForumTopics[ gidTopic ].Subscribe( Forum_SwapSubscribeButtons.bind( null, gidTopic, true ) );
}

function Forum_UnsubscribeFromTopic( gidTopic )
{
	if ( g_rgForumTopics[ gidTopic ] )
		g_rgForumTopics[ gidTopic ].Unsubscribe( Forum_SwapSubscribeButtons.bind( null, gidTopic, false ) );
}

function Forum_ResolveReports( gidTopic )
{
	if ( g_rgForumTopics[ gidTopic ] )
		g_rgForumTopics[ gidTopic ].ResolveReports();
}

function Forum_SwapSubscribeButtons( gidForumTopic, bSubscribed )
{
	if ( bSubscribed )
	{
		$('forum_subscribe_' + gidForumTopic).hide();
		$('forum_unsubscribe_' + gidForumTopic).show();
	}
	else
	{
		$('forum_subscribe_' + gidForumTopic).show();
		$('forum_unsubscribe_' + gidForumTopic).hide();
	}
}

function Forum_SubmitReport( elForm )
{
	var gidTopic = elForm.elements['gidtopic'].value;

	if ( g_rgForumTopics[ gidTopic ] )
		g_rgForumTopics[ gidTopic ].SubmitReportPost();
}

function Forum_EditTopic( gidTopic )
{
	$('forum_op_' + gidTopic).hide();
	$('forum_topic_edit_' + gidTopic).show();

	// size the text box to the content
	if ( g_rgForumTopics[ gidTopic ] )
		g_rgForumTopics[ gidTopic ].CheckTextAreaSize();
}

function Forum_CancelEditTopic( gidTopic )
{
	$('forum_op_' + gidTopic).show();
	$('forum_topic_edit_' + gidTopic).hide();
}

function Forum_SubmitTopicChanges( gidTopic, form )
{
	var title = form.elements['topic'].value;
	var text = form.elements['text'].value;
	if ( g_rgForumTopics[ gidTopic ] )
		g_rgForumTopics[ gidTopic ].Edit( title, text );
}

function Forum_EraseNestedQuotes( strText )
{
	var strOutput = '';

		var strTextLower = strText.toLowerCase();

	var iCur = 0;
	var nQuoteLevel = 0;
	var iNextQuote = strTextLower.indexOf( '[quote' );
	var iNextEndQuote = strTextLower.indexOf( '[/quote]' );
	while( iNextQuote != -1 || iNextEndQuote != -1 )
	{
		if ( iNextQuote != -1 && iNextQuote < iNextEndQuote )
		{
			if ( nQuoteLevel < 2 )
				strOutput += strText.substr( iCur, iNextQuote - iCur );
			iCur = iNextQuote;
			iNextQuote = strTextLower.indexOf( '[quote', iCur + 1 );
			nQuoteLevel++;
		}
		else if ( iNextEndQuote != -1 )
		{
			if ( nQuoteLevel < 2 )
			{
				strOutput += strText.substr( iCur, iNextEndQuote + 8 - iCur );
			}
			iCur = iNextEndQuote + 8;	// strlen( '[/quote]' )
			iNextEndQuote = strTextLower.indexOf( '[/quote', iCur + 1 );
			nQuoteLevel--;
		}
		else
		{
			// unbalanced/invalid state
			break;
		}
	}
	strOutput += strText.substr( iCur );

	return strOutput;
}

function Forum_ReplyToPost( gidTopic, gidComment )
{
	var CommentThread = g_rgForumTopicCommentThreads[gidTopic];
	var rgRawComment;
	if ( gidComment && gidComment != -1 )
	{
		rgRawComment = CommentThread.GetRawComment( gidComment );
	}
	else
	{
		// topic quoting
		rgRawComment = g_rgForumTopics[gidTopic].m_rgRawData;
	}

	var elTextArea = CommentThread.GetCommentTextEntryElement();


	if ( elTextArea.value && elTextArea.value.length > 0 )
		elTextArea.value += '\n\n';
	elTextArea.value += '[quote=' + rgRawComment.author.replace( /[\[\];]/g, '' );

	if ( gidComment && gidComment != -1 )
		elTextArea.value += ';' + gidComment;

	elTextArea.value += ']' + Forum_EraseNestedQuotes( v_trim( rgRawComment.text ) ) + ' [/quote]\n';


	elTextArea.focus();

	// resize the text area
	CommentThread.CheckTextAreaSize();

	ScrollToIfNotInView( elTextArea, 80, 40 );
}

function Forum_ShowMoreAwardsForTopic( id )
{
	$J( "#community_awards_forum_topic_" + id ).addClass( "show_all_awards" );
}

function Forum_ShowMoreAwardsForComment( id )
{
	$J( "#community_awards_comment_" + id ).addClass( "show_all_awards" );
}

function Forum_OnCommunityAwardGranted( containerNamePrefix, id, award )
{
	var rewardsCtn = $J( "#" + containerNamePrefix + id );
	if ( rewardsCtn.length != 0 )
	{
		var bFoundExisting = false;
		var rewards = rewardsCtn.find( ".community_award" );
		for ( var j = 0; j < rewards.length; ++j )
		{
			var reward = $J( rewards[j] );
			if ( reward.data( "reaction" ) == award )
			{
				bFoundExisting = true;

				var count = parseInt( reward.data( "reactioncount" ) );
				var countElem = reward.find( ".community_award_count" );
				countElem.text( count + 1 );
				countElem.removeClass( "hidden" );

				reward.data( "reactioncount", count + 1 );
				rewardsCtn.prepend( reward );
				break;
			}
		}

		if ( !bFoundExisting )
		{
			var reward = $J( "<span>", { class: "community_award" } );
			var img = $J( "<img>", { class: "community_award_icon tooltip", src: "https://store.akamai.steamstatic.com/public/images/loyalty/reactions/still/" + award + ".png" } );
			reward.append( img );

			var countElem = $J( "<span>", { class: "community_award_count hidden", text: "1" } );
			reward.append( countElem );
			reward.data( "reaction", award );
			reward.data( "reactioncount", 1 );
			rewardsCtn.prepend( reward );

			// find "show more" button
			var moreElem = rewardsCtn.find( ".community_award.more_btn" );
			if ( moreElem.length != 0 )
			{
				var moreCount = parseInt( moreElem.data( 'count' ) );
				moreElem.data( 'count', moreCount + 1 );
				var countElem = moreElem.find( ".community_award_count" );
				countElem.text( moreCount + 1 );
			}
			else
			{
				// fallback and show everything if the user is adding things
				rewardsCtn.addClass( "show_all_awards" );
			}
		}
	}
}

function Forum_ShowAwardDialogForTopic( gidTopic, currentSelection )
{
	function callbackFunc( id, award )
	{
		Forum_OnCommunityAwardGranted( "community_awards_forum_topic_", id, award );
	};
	fnLoyalty_ShowAwardModal( gidTopic, 4, callbackFunc, undefined, currentSelection );
}

function Forum_ShowAwardDialogForComment( gidComment, currentSelection )
{
	function callbackFunc( id, award )
	{
		Forum_OnCommunityAwardGranted( "community_awards_comment_", id, award );
	};
	fnLoyalty_ShowAwardModal( gidComment, 5, callbackFunc, undefined, currentSelection );
}

var g_elAuthorMenu = null;
function Forum_AuthorMenu( elLink, accountIDTarget, gidComment )
{
	var $Link = $J(elLink);
	var $Menu = $Link.siblings('.forum_author_menu');

	// reparent the author menu first, so we can make sure it's in the document
	var $Parent = $Link.parents('.commentthread_comment, .forum_op');
	$Parent.css( 'overflow', 'visible' );


	$Menu.css('min-width', $Link.width() + 'px' );

	ShowMenu( $Link, $Menu, 'left', 'bottom', 2 );

	return false;
}

function Forum_ShowForumAudits( gidForumTopic, gidObject )
{
	if ( g_rgForumTopics[ gidForumTopic ] )
	{
		g_rgForumTopics[ gidForumTopic ].ShowAudits( gidObject );
	}
}

function Forum_CloseTradingTopic( gidForumTopic )
{
	ShowConfirmDialog( '????ng ????? t??i n??y', '????nh d???u "????ng" trong topic n??y b???n s??? kh??ng th??? tr??? l???i hay ????? ngh??? trao ?????i n???a. M???t khi n?? ????ng, b???n s??? kh??ng th??? l??m g?? ???????c h???t.', '????ng ????? t??i n??y')
	.done( function() {
		Forum_SetTopicFlag( gidForumTopic, 'locked', true );
	})
}

function ShowForumSuccessDialog( strTitle, strDetails )
{
	ShowForumSuccessDialogWithDetailTitle( strTitle, null, strDetails );
}

function ShowForumSuccessDialogWithDetailTitle( strTitle, strDetailTitle, strDetails )
{
	var $Content = $J('<div/>');

	if ( strDetailTitle )
		$Content.append( $J('<h2/>', {'class': 'forum_modal_detailtitle'} ).html( strDetailTitle ) );

	$Content.append( $J('<div/>' ).html(strDetails) );
	var Modal = ShowAlertDialog( strTitle, $Content );
	Modal.GetContent().css( 'width', '400px' );

}

CForumTopic = Class.create( {

	m_rgForumData: null,
	m_strActionURL: null,
	m_gidForumTopic: null,
	m_rgRawData: null,	//raw text and author data, for editing/quoting

	m_bAJAXInFlight: false,

	// for editing
	m_elTextArea: null,
	m_oTextAreaSizer: null,

	initialize: function( rgForumData, url, gidTopic, rgRawData )
	{
		this.m_rgForumData = rgForumData;
		this.m_strActionURL = url;
		this.m_gidForumTopic = gidTopic;
		this.m_rgRawData = rgRawData;


		this.m_elTextArea = $( 'forum_topic_edit_' + gidTopic + '_textarea');

		if ( this.m_elTextArea )
		{
			this.m_oTextAreaSizer = new CAutoSizingTextArea( this.m_elTextArea, 40 );
		}

	},

	CheckTextAreaSize: function()
	{
		this.m_oTextAreaSizer && this.m_oTextAreaSizer.OnTextInput();
	},

	GetActionURL: function( action )
	{
		var url = this.m_strActionURL + action + '/';
		if ( this.m_rgForumData['feature'] )
			url += this.m_rgForumData['feature'] + '/';
		return url;
	},

	ParametersWithDefaults: function( params )
	{
		if ( !params )
			params = {};

		params['gidforumtopic'] = this.m_gidForumTopic;
		params['sessionid'] = g_sessionID;

		return params;
	},

	Edit: function( title, text )
	{
		if ( this.m_bAJAXInFlight )
			return;

		this.m_bAJAXInFlight = true;

		new Ajax.Request( this.GetActionURL( 'edittopic' ), {
			method: 'post',
			parameters: this.ParametersWithDefaults( { title: title, text: text } ),
			onSuccess: function() { window.location.reload() },
			onFailure: this.OnModeratorActionFailed.bind(this)
		});
	},

	Delete: function( fnOnSuccess )
	{
		if ( this.m_bAJAXInFlight )
			return;

		this.m_bAJAXInFlight = true;

		new Ajax.Request( this.GetActionURL( 'deletetopic' ), {
			method: 'post',
			parameters: this.ParametersWithDefaults(),
			onSuccess: fnOnSuccess ? fnOnSuccess : this.RedirectToTopicListPage.bind(this),
			onFailure: this.OnModeratorActionFailed.bind(this)
		} );
	},

	SetTopicFlag: function( flag, value )
	{
		if ( this.m_bAJAXInFlight )
			return;

		this.m_bAJAXInFlight = true;

		var fnOnSuccess = function() { window.location.reload(); };
		if ( flag == 'purge' )
			fnOnSuccess = this.RedirectToTopicListPage.bind(this);

		new Ajax.Request( this.GetActionURL( 'moderatetopic' ), {
			method: 'post',
			parameters: this.ParametersWithDefaults( { action: 'setflag', flag: flag, value: value } ),
			onSuccess: fnOnSuccess,
			onFailure: this.OnModeratorActionFailed.bind(this)
		});
	},

	ReportPost: function( author, gidcomment )
	{
		var form = $('forum_reportpost_form');

		// blank out the text area if the user is making a new report
		if ( form.elements['gidcomment'].value != gidcomment )
			form.elements['report_reason'].value = '';

		form.elements['author'].value = author;
		form.elements['gidcomment'].value = gidcomment;
		form.elements['gidtopic'].value = this.m_gidForumTopic;

		var _this = this;
		var $ReportModalContent = $J('#report_modal_content');
		ShowConfirmDialog(
			'B??o c??o b??i vi???t n??y',
			$ReportModalContent.show(),
			'T??? c??o'
		).done( function() {
			$J(document.body ).append( $ReportModalContent.hide() );
			_this.SubmitReportPost();
		} ).fail( function() {
			$J(document.body ).append( $ReportModalContent.hide() );
		});

		form.elements['report_reason'].focus();
	},

	SubmitReportPost: function()
	{
		var form = $('forum_reportpost_form');

		var author = form.elements['author'].value;
		var gidcomment = form.elements['gidcomment'].value;
		var report = form.elements['report_reason'].value;

		if ( report && report.length > 0 )
		{
			new Ajax.Request( this.GetActionURL( 'reportpost' ), {
				method: 'post',
				parameters: this.ParametersWithDefaults( { author: author, gidcomment: gidcomment, report: report } ),
				onSuccess: this.OnReportPostSuccess.bind(this),
				onFailure: this.OnModeratorActionFailed.bind(this)
			});
		}

		form.elements['report_reason'].value='';
	},

	OnReportPostSuccess: function()
	{
		ShowForumSuccessDialogWithDetailTitle( 'T??? c??o', 'C???m ??n b???n ???? g???i b??o c??o', 'B??o c??o c???a b???n ???? ???????c g???i ?????n nh???ng ng?????i ki???m duy???t ????? xem x??t. Ch??ng t??i s??? cho b???n bi???t n???u ti???n h??nh bi???n ph??p x??? l?? ph?? h???p.' );
	},

	MoveTopic: function()
	{
		Forum_MoveTopics( this.GetActionURL( 'movetopic' ), this.m_rgForumData, [ this.m_gidForumTopic ])
			.done( this.OnMoveTopicSuccess.bind(this) )
			.fail( this.OnModeratorActionFailed.bind(this) );

	},

	OnMoveTopicSuccess: function( transport )
	{
		var strNewURL = null;
		if ( transport && transport.responseJSON && transport.responseJSON.newtopic )
			strNewURL = transport.responseJSON.newtopic;

		$('forum_movetopic_results_back').observe( 'click', this.RedirectToTopicListPage.bind(this) );

		if ( strNewURL )
			$('forum_movetopic_results_topic').observe( 'click', function() { window.location = strNewURL; } );
		else
			$('forum_movetopic_results_topic').hide();

		showContentAsModal( 'forum_modal', $('forum_movetopic_results') );
	},

	RedirectToTopicListPage: function()
	{
		window.location = this.m_rgForumData['forum_url'];
	},

	OnModeratorActionFailed: function( transport )
	{
		this.m_bAJAXInFlight = false;
		if( transport.responseJSON && 'msg' in transport.responseJSON )
		{
			ShowForumSuccessDialog( '', 'S???a ch??? ????? th???t b???i. Th??ng ??i???p l???i:' +
			 "<br><br>" + transport.responseJSON.msg );
		}
		else
		{
			ShowForumSuccessDialog( '', 'Ch???nh s???a ch??? ????? kh??ng th??nh c??ng. Xin vui l??ng th??? l???i sau.' );
		}
	},

	RecordTopicViewed: function( timelastpost )
	{
		// fire and forget (success sets a cookie)
		new Ajax.Request( this.GetActionURL( 'recordtopicviewed' ), {
			method: 'post',
			parameters: this.ParametersWithDefaults( { timelastpost: timelastpost ? timelastpost + 1 : 0 } )
		});
	},

	Subscribe: function( fnExternalOnSuccess )
	{
		if ( g_rgForumTopicCommentThreads[ this.m_gidForumTopic ] )
		{
			var fnSuccess = function() {
				ShowForumSuccessDialogWithDetailTitle( 'Theo d??i th???o lu???n', 'B???n ???? ????ng k?? theo d??i th???o lu???n n??y.', 'B???n s??? nh???n ???????c m???t l???i nh???n khi ai ???? g???i c??u tr??? l???i t???i th???o lu???n n??y.' );
				fnExternalOnSuccess();
			};
			var fnFail = ShowForumSuccessDialog.bind( null, 'Theo d??i th???o lu???n', 'Xin th??? l???i, ch??ng t??i kh??ng th??? ????ng k?? cho b???n theo d??i cu???c th???o lu???n n??y. Xin vui l??ng th??? l???i sau.');
			g_rgForumTopicCommentThreads[ this.m_gidForumTopic ].Subscribe( fnSuccess, fnFail );
		}
	},

	Unsubscribe: function( fnExternalOnSuccess )
	{
		if ( g_rgForumTopicCommentThreads[ this.m_gidForumTopic ] )
		{
			var fnSuccess = function() {
				ShowForumSuccessDialogWithDetailTitle( 'H???y theo d??i th???o lu???n', 'B???n ???? h???y theo d??i th???o lu???n n??y.', 'B???n s??? kh??ng c??n nh???n th??ng b??o b??nh lu???n t??? th???o lu???n n??y.' );
				fnExternalOnSuccess();
			};
			var fnFail = ShowForumSuccessDialog.bind( null, 'H???y theo d??i th???o lu???n', 'Xin th??? l???i, ch??ng t??i kh??ng th??? h???y ????ng k?? theo d??i c???a b???n cho cu???c th???o lu???n n??y. Xin vui l??ng th??? l???i sau.');
			g_rgForumTopicCommentThreads[ this.m_gidForumTopic ].Unsubscribe( fnSuccess, fnFail );
		}
	},

	ResolveReports: function()
	{
		if ( this.m_bAJAXInFlight )
			return;

		this.m_bAJAXInFlight = true;

		var Topic = this;
		new Ajax.Request( this.GetActionURL( 'moderatetopic' ), {
			method: 'post',
			parameters: this.ParametersWithDefaults( { action: 'resolvereports' } ),
			onSuccess: function(transport) {
				var cReportsResolved = transport.responseJSON.resolved_count || 0;
				var strMessage;
				if ( cReportsResolved > 0 )
					strMessage = 'Nh???ng b??o c??o c?? li??n quan ?????n ch??? ????? n??y ?????u ???? ???????c ????nh d???u l?? ???? gi???i quy???t.<br>s??? b??o c??o c???n gi???i quy???t: ' + cReportsResolved;
				else
					strMessage = 'Nh???ng b??o c??o c?? li??n quan ?????n ch??? ????? n??y ?????u ???? ???????c ????nh d???u l?? ???? gi???i quy???t.';

				ShowForumSuccessDialogWithDetailTitle( 'Gi???i quy???t b??i b??o c??o', 'B??o c??o ???? ???????c gi???i quy???t.', strMessage );
				Topic.m_bAJAXInFlight = false;
			},
			onFailure: this.OnModeratorActionFailed.bind(this)
		});
	},

	ShowAudits: function ( gidObject )
	{
		var strURL = this.GetActionURL( 'auditlog' );
		var rgParams = { gidforumtopic: this.m_gidForumTopic, gidobject: gidObject, ajax: 1 };

		$J.get( strURL, rgParams ).done( function(data) {
			ShowAlertDialog( 'L???ch s??? b??i vi???t', data );
		});
	},

	GetSearchURL: function( rgSearchParams )
	{
		var strBaseURL = this.m_rgForumData['forum_search_url'];
		if ( this.m_rgForumData['type'] == 'Workshop' )
			rgSearchParams['appid'] = this.m_rgForumData['appid'];

		return strBaseURL + '?' + Object.toQueryString( rgSearchParams );
	},

	BCheckPermission: function( strPermissionName )
	{
		return this.m_rgForumData.permissions && this.m_rgForumData.permissions[strPermissionName] == 1;
	}

} );

CCommentThreadForumTopic = Class.create( CCommentThread, {

	m_iInitialPage: 0,

	initialize: function( $super, type, name, rgCommentData, url, quoteBoxHeight )
	{
		$super( type, name, rgCommentData, url, quoteBoxHeight );

		this.m_iInitialPage = this.m_iCurrentPage;

		// watch for incoming # urls
		BindOnHashChange( this.OnLocationChange.bind( this ) );
		this.OnLocationChange( window.location.hash );

		if ( this.m_rgCommentData && this.m_rgCommentData.lastvisit )
		{
			var rgNewComments = $$('.commentthread_newcomment');
			if ( rgNewComments.length > 0 )
			{
				ScrollToIfNotInView( rgNewComments[0], 5000, 36 );
			}
		}

		RegisterForumTopicCommentThread( this.m_rgCommentData['feature2'], this );
	},

	GetForumTopic: function()
	{
		return g_rgForumTopics[ this.m_rgCommentData.feature2 ];
	},

	OnLocationChange: function( hash )
	{
		if ( hash.match( /^#c[0-9]+$/ ) )
		{
			var gidComment = hash.substring(2);
			if ( !$( 'comment_' + gidComment ) )
				this.GoToPageWithComment( gidComment, CCommentThread.RENDER_GOTOCOMMENT_HASHCHANGE );
			else
				this.UpdatePermLinkHighlight();
		}
		else if ( hash.match( /^#p[0-9]+$/ ) )
		{
			var iPage = parseInt( hash.substring(2) ) - 1;
			if ( this.m_iCurrentPage != iPage )
				this.GoToPage( iPage, CCommentThread.RENDER_GOTOPAGE_HASHCHANGE );
		}
		else if ( !hash )
		{
			// reset to initial view
			//this.GoToPage( this.m_iInitialPage );
			this.UpdatePermLinkHighlight();
		}
	},

	UpdatePermLinkHighlight: function()
	{
		var elContainer = $('commentthread_' + this.m_strName + '_posts' );
		elContainer.childElements().invoke( 'removeClassName', 'permlinked' );

		var hash = window.location.hash;
		if ( hash && hash.length > 2 && hash.match( /#c[0-9]+/ ) )
		{
			var elComment = $('comment_' + hash.substring( 2 ));
			var elDeletedComment = $('deleted_comment_' + hash.substring( 2 ));
			if ( elComment )
			{
				if ( elDeletedComment )
				{
					elDeletedComment.hide();
					elComment.show();
				}
				elComment.addClassName( 'permlinked' );
				ScrollToIfNotInView.defer( elComment, 5000, 36 );
			}
		}
	},

	/* override to get rid of animation */
	DoTransitionToNewPosts: function( response, eRenderReason )
	{
		var strNewHTML = response.comments_html;

		var elPosts = $('commentthread_' + this.m_strName + '_posts' );
		var elContainer = $('commentthread_' + this.m_strName + '_postcontainer' );
		var elArea = $('commentthread_' + this.m_strName + '_area' );

		var topic = g_rgForumTopics[ this.m_rgCommentData['feature2'] ];

		var bNewPost = ( eRenderReason == CCommentThread.RENDER_NEWPOST );

		// new posts get an animation, anything else just gets snapped in
		elContainer.style.height = elContainer.getHeight() + 'px';

		elPosts.update( strNewHTML );
		Forum_InitPostAndCommentControls( elPosts );

		if ( eRenderReason == CCommentThread.RENDER_GOTOPAGE || eRenderReason == CCommentThread.RENDER_NEWPOST )
		{
			if ( ( !window.history || !window.history.pushState ) && ( this.m_iCurrentPage != this.m_iInitialPage || window.location.hash.length > 1 ) )
				window.location.hash = 'p' + ( this.m_iCurrentPage + 1);
		}
		else
			this.UpdatePermLinkHighlight();

		if ( bNewPost )
		{
			if ( elContainer.effect )
				elContainer.effect.cancel();

			window.setTimeout( function() {
				elContainer.effect = new Effect.Morph( elContainer, { style: 'height: ' + elPosts.getHeight() + 'px', duration: 0.25, afterFinish: function() { elPosts.style.position = 'static'; elContainer.style.height = 'auto';  } } );
			}, 10 );
		}
		else
		{
			elContainer.style.height = '';
			if ( eRenderReason != CCommentThread.RENDER_GOTOCOMMENT && eRenderReason != CCommentThread.RENDER_GOTOCOMMENT_HASHCHANGE && eRenderReason != CCommentThread.RENDER_DELETEDPOST && eRenderReason != CCommentThread.RENDER_GOTOPAGE_HASHCHANGE )
				ScrollToIfNotInView.defer( elArea, 80, 40 );
		}

		if ( this.m_iCurrentPage == this.m_cMaxPages - 1 )
		{
			if ( topic )
				topic.RecordTopicViewed( response.timelastpost );
		}

	},


	DeleteComment: function( $super, gidComment, bUndelete, fnOnSuccess )
	{
		if ( fnOnSuccess )
		{
			// special global reports mode
			$super( gidComment, bUndelete, fnOnSuccess );
			return;
		}
		var Topic = this.GetForumTopic();
		var bIsModerator = Topic && Topic.BCheckPermission( 'can_moderate' );

		var fnOnConfirm = $super.bind( this, gidComment, bUndelete );
		if ( !bUndelete && !bIsModerator )
		{
			ShowConfirmDialog( '', 'B???n c?? th???t s??? mu???n x??a b??i vi???t n??y?', 'X??a' )
				.done( function() { fnOnConfirm(); } );
		}
		else
		{
			// no confirmation for undeleting or for moderators (who can just undo the delete if they decide it was a bad idea
			fnOnConfirm();
		}
	}

});

function Forum_RecordPotentialMergeTarget( rgForumData, gidTopic, strTitle )
{
	var rgTargetEntry = { unClanIDOwner: rgForumData.owner, gidForum: rgForumData.gidforum, gidTopic: gidTopic, strTitle: strTitle };
	try
	{
		var rgTargets = _Forum_GetPotentialMergeTargets();
		for ( var i=0; i < rgTargets.length; i++ )
		{
			if ( rgTargets[i].gidTopic == gidTopic )
			{
				rgTargets.splice( i, 1 );
				break;
			}
		}
		rgTargets.unshift( rgTargetEntry );
		_Forum_UpdatePotentialMergeTargets( rgTargets );
	}
	catch ( e )
	{
		var rgTargetsNew = [ rgTargetEntry ];
		WebStorage.SetLocal( 'rgForumMergeTargets', rgTargetsNew );
	}
}

function _Forum_GetPotentialMergeTargets()
{
	var rgForumMergeTargets = [];
	try
	{
		rgForumMergeTargets = WebStorage.GetLocal( 'rgForumMergeTargets' );
	}
	catch ( e ) {}

	if ( !rgForumMergeTargets || !rgForumMergeTargets.length )
		rgForumMergeTargets = [];

	return rgForumMergeTargets;
}

function _Forum_UpdatePotentialMergeTargets( rgTargets )
{
	rgTargets.splice( 10 );	//max we will track
	WebStorage.SetLocal( 'rgForumMergeTargets', rgTargets );
}

var g_rgRedirectTimeOptions = [
	{value: 0, label: 'Kh??ng c?? ???????ng d???n' },
	{value: 1, label: '1 gi???' },
	{value: 24, label: '1 ng??y' },
	{value: 168, label: '1 tu???n' },
	{value: 720, label: '1 th??ng' },
	{value: -1, label: 'M??i m??i' }
];
function Forum_MergeTopicDialog( strActionURL, rgForumData, rgForumTopics, bResolveReports )
{
	var $DialogContent = $J('<div/>', {'class': 'merge_topic_dialog'} );
	var $MergeForm = $J('<form/>' );
	$DialogContent.append( $MergeForm );

	var strMessage = 'H???p nh???t c??c ch??? ????? v??o chung v???i nhau s??? di chuy???n t???t c??? c??c b??i ????ng t??? ch??? ????? n??y sang ch??? ????? kia. N???u trong ch??? ????? ???????c h???p nh???t ???? c?? b??i ????ng, c??c b??i ????ng s??? ???????c h???p nh???t xen k??? d???a theo th???i ??i???m ???????c ????ng. H??nh ?????ng n??y kh??ng th??? ho??n t??c ???????c.<br><br>';
	strMessage += rgForumTopics.length > 1 ? 'Ch???n m???t ch??? ????? ???????c xem g???n ????y ????? k???t h???p c??c ch??? ????? ???????c l???a ch???n v??o:' : 'Ch???n m???t ch??? ????? ???????c xem g???n ????y k???t h???p v??o ch??? ????? n??y:';

	$MergeForm.append( $J('<div/>', {'class': 'merge_topic_dialog_content' }).html( strMessage ) );

	var $List = $J('<div/>', {'class': 'merge_topic_target_list' } );
	$MergeForm.append( $List );

	var strMoreInstructions = 'N???u ch??? ????? b???n mu???n k???t h???p kh??ng ???????c li???t k?? ??? ????y, b???n c?? th??? <%1$s>duy???t c??c ch??? ????? b???n mu???n<%2$s> trong m???t c???a s??? m???i. Danh s??ch n??y s??? ???????c t??? ?????ng c???p nh???t khi b???n quay tr??? l???i.'.replace( /%1\$s/, 'a class="whiteLink" href="' + rgForumData.forum_url + '" target="_blank"').replace( /%2\$s/, '/a' );
	$MergeForm.append( $J('<div/>', {'class': 'merge_topic_dialog_content' }).html( strMoreInstructions ) );

	// redirect section
	var $Expiry = $J('<div/>', {'class': 'merge_topic_dialog_content' });
	var $Select = $J('<select/>', {name: 'redirect_expiry_hours', style: 'width: 240px;' } );
	for ( var i = 0; i < g_rgRedirectTimeOptions.length; i++ )
	{
		var rgOpt = g_rgRedirectTimeOptions[i];
		$Select.append( $J('<option/>', {value: rgOpt.value }).text( rgOpt.label) );
	}
	Forum_InitExpiryOptions( $Select );
	$Expiry.append( '????? l???i chuy???n h?????ng cho: ', $Select );
	$MergeForm.append( $Expiry );

	// merge target list
	var fnMakeMergeOption = function( unClanIDOwner, gidForum, gidTopic, strLabel ) {
		var $Item = $J('<div/>', {'class': 'ellipsis'} );
		var id = 'merge_target_' + gidTopic;
		// use html5 data, jquery data disappears when the modal is dismissed
		var $Radio = $J('<input/>', {type: 'radio', name: 'merge_target', value: gidTopic, id: id,
			'data-unclanidowner': unClanIDOwner, 'data-gidforum': gidForum } );
		var $Label = $J('<label/>', {'for': id }).text( strLabel );
		$Item.append( $Radio, $Label );
		return $Item;
	}

	var oSelectedTopics = {};
	for( var i = 0; i< rgForumTopics.length; i++ )
		oSelectedTopics[rgForumTopics[i]] = true;

	var fnPopulateMergeOptions = function() {
		var cTopicsToShow = 5;
		$List.html('');
		if ( rgForumTopics.length > 1 )
		{
			var $MergeTogether = fnMakeMergeOption( 0, 0, 0, 'K???t h???p c??c ch??? ????? l???i v???i nhau th??nh m???t ch??? ????? l??u ?????i nh???t' );
			$MergeTogether.addClass( 'merge_topic_together_option');
			$List.append( $MergeTogether );
			$MergeTogether.children( 'input').prop( 'checked', true );
			cTopicsToShow--;
		}
		var rgMergeTargets = _Forum_GetPotentialMergeTargets();
		for ( var i = 0; i < rgMergeTargets.length; i++ )
		{
			var rgTarget = rgMergeTargets[i];
			// skip it if it's one of the ones we're merging
			if ( oSelectedTopics[ rgTarget.gidTopic] )
				continue;

			$List.append( fnMakeMergeOption( rgTarget.unClanIDOwner, rgTarget.gidForum, rgTarget.gidTopic, rgTarget.strTitle ) );

			if ( --cTopicsToShow == 0 )
				break;
		}
	}
	fnPopulateMergeOptions();

	var strInitialMergeTargetsJSON = WebStorage.GetLocal( 'rgForumMergeTargets' ) || [];
	var nTimeoutCheckMergeTargets = window.setInterval( function() {
		var strMergeTargetsJSON = WebStorage.GetLocal( 'rgForumMergeTargets' ) || [];
		if ( strMergeTargetsJSON != strInitialMergeTargetsJSON )
		{
			var strSelectedOption = $List.find( 'input:checked').val();
			fnPopulateMergeOptions();
			strInitialMergeTargetsJSON = strMergeTargetsJSON;

			// restore whatever they had selected before we reloaded (if it's still there )
			if ( typeof strSelectedOption != 'undefined' )
				$List.find( 'input[value="' + strSelectedOption + '"]').prop( 'checked', true );
		}
	}, 200 );


	var deferred = $J.Deferred();

	var Modal = ShowConfirmDialog( 'K???t h???p ch??? ?????', $DialogContent, 'K???t h???p ch??? ?????' );
	//Modal.fail( function() { Deferred.reject(); } );
	Modal.done( function() {
		var params = {};
		params['sessionid'] = g_sessionID;
		params['gidforumtopic_list'] = V_ToJSON( rgForumTopics );
		params['source_forum_name'] = rgForumData.forum_display_name;
		params['redirect_expiry_hours'] = $Select.val();
		if ( bResolveReports )
			params['resolve_reports'] = 1;

		var $SelectedTarget = $List.find( 'input:checked' );
		if ( !$SelectedTarget.length )
			return;

		// not having a value implies our "merge together" option
		if ( $SelectedTarget.val() )
		{
			params['destination_clanidowner'] = $SelectedTarget.data( 'unclanidowner' );
			params['destination_gidforum'] = $SelectedTarget.data( 'gidforum' );
			params['destination_gidtopic'] = $SelectedTarget.val();
		}

		new Ajax.Request( strActionURL, {
			method: 'post',
			parameters: params,
			onSuccess: deferred.resolve.bind( deferred ),
			onFailure: deferred.reject.bind( deferred )
		});
	}).always( function() {
		window.clearInterval( nTimeoutCheckMergeTargets );
	});

	return deferred;
}

function Forum_MoveTopics( strActionURL, rgForumData, rgForumTopics, bResolveReports )
{
	var form = $('forum_movetopic_form');

	// blank out the text area if the user is making a new report
	form.elements['gidforumtopic_list'].value = V_ToJSON( rgForumTopics );
	form.elements['source_forum_name'].value = rgForumData.forum_display_name;
	Forum_InitExpiryOptions( $J( form.elements['redirect_expiry_hours'] ) );

	var deferred = new jQuery.Deferred();

	Forum_SetMoveTopicClan( rgForumData['owner'], null );

	if ( $('associate_game' ) && $('game_select_suggestions_ctn') && $('game_select_suggestions') && !$('associate_game').m_bInitialized )
	{
		var elAssociateGame = $('associate_game');
		elAssociateGame.m_bInitialized = true;
		new CGameSelector( $('associate_game'), $('game_select_suggestions_ctn'), $('game_select_suggestions'), Forum_OnMoveTopicSelectGame );
	}


	var fnSubmitMoveTopic = function() {
		var params = form.serialize( true );
		params['sessionid'] = g_sessionID;
		if ( bResolveReports )
			params['resolve_reports'] = 1;

		var elSelect = form.elements['destination_gidforum'];

		new Ajax.Request( strActionURL, {
			method: 'post',
			parameters: params,
			onSuccess: deferred.resolve.bind( deferred ),
			onFailure: deferred.reject.bind( deferred )
		});
	};

	if ( !$('submit_move_topic_button').m_bBound )
	{
		$('submit_move_topic_button').observe( 'click', fnSubmitMoveTopic );
		$('submit_move_topic_button').m_bBound = true;
	}

	if ( $('forum_movetopic_globaldestinations') && !$('forum_movetopic_globaldestinations').m_bBound )
	{
		$('forum_movetopic_globaldestinations').observe( 'click', Forum_SetMoveTopicClan.bind( null, false, 753 ) );
		$('forum_movetopic_globaldestinations').m_bBound = true;
	}

	showContentAsModal( 'forum_modal', $('forum_movetopic_modal_content') );

	return deferred;
}


function Forum_SetMoveTopicClan( clanidowner, appidowner )
{
	var form = $('forum_movetopic_form');
	var rgReloadParams = null;
	if ( clanidowner )
	{
		if ( form.elements['destination_clanidowner'].value != clanidowner )
		{
			form.elements['destination_clanidowner'].value = clanidowner;
			form.elements['destination_appidowner'].value = '';
			rgReloadParams = { destination_clanid: clanidowner };
		}
	}
	else if ( appidowner )
	{
		if ( form.elements['destination_appidowner'].value != appidowner )
		{
			form.elements['destination_clanidowner'].value = '';
			form.elements['destination_appidowner'].value = appidowner;
			rgReloadParams = { destination_appid: appidowner };
		}
	}

	if ( rgReloadParams )
	{
		$(form.elements['destination_gidforum']).hide();
		$('forum_movetopic_destination_throbber').show();
		$('forum_movetopic_destinationclan') && $('forum_movetopic_destinationclan').update('&nbsp;');
		$('forum_movetopic_destination_unavailable').hide();
		rgReloadParams['sessionid'] = g_sessionID;

		new Ajax.Request( 'https://steamcommunity.com/forum/0/General/gettopicdestinations/', {
			method: 'get',
			parameters: rgReloadParams,
			onSuccess: Forum_OnMoveTopicDestinations.bind( null, clanidowner, appidowner ),
			onFailure: Forum_OnMoveTopicDestinationsFailed.bind( null, clanidowner, appidowner )
		} );
	}
}

function Forum_OnMoveTopicSelectGame( GameSelector, rgAppData )
{
	$('associate_game').value='';

	Forum_SetMoveTopicClan( false, rgAppData.appid );
}

function Forum_OnMoveTopicDestinations( clanidowner, appidowner, transport )
{
	var form = $('forum_movetopic_form');
	if ( ( !clanidowner || form.elements['destination_clanidowner'].value == clanidowner ) &&
		( !appidowner || form.elements['destination_appidowner'].value == appidowner ) )
	{
		$('forum_movetopic_destination_throbber').hide();
		var $Select = $J(form.elements['destination_gidforum']);
		$Select.html('');
		var rgForums = transport.responseJSON.rgForums;
		if ( rgForums && rgForums.length > 0 )
		{
			for ( var i = 0; i < rgForums.length; i++ )
			{
				var rgForum = rgForums[i];
				var $Option = $J( '<option/>', { value: rgForum.gidforum } );
				$Option.text( rgForum.name );
				$Select.append( $Option );
			}
		}
		else
		{
			Forum_OnMoveTopicDestinationsFailed( clanidowner, appidowner, transport );
			return;
		}

		var elName = $('forum_movetopic_destinationclan');
		if ( elName )
			elName.update( transport.responseJSON.strName );

		$Select.show();
		$Select.focus();
		$('submit_move_topic_button').show();
	}
}

function Forum_OnMoveTopicDestinationsFailed( clanidowner, appidowner, transport )
{
	var form = $('forum_movetopic_form');
	if ( ( !clanidowner || form.elements['destination_clanidowner'].value == clanidowner ) &&
		( !appidowner || form.elements['destination_appidowner'].value == appidowner ) )
	{
		$('forum_movetopic_destination_throbber').hide();
		$(form.elements['destination_gidforum']).hide();
		$('forum_movetopic_destination_unavailable').show();
		$('submit_move_topic_button').hide();
	}
}

function V_CountKeys( obj )
{
	if ( Object.keys )
		return Object.keys(obj).length;
	else
	{
		var c = 0;
		for ( var x in obj )
			c++;
		return c;
	}
}

function V_Keys( obj )
{
	if ( Object.keys )
		return Object.keys( obj );
	else
	{
		var rgResults = [];
		for ( var x in obj )
			rgResults.push( x );
		return rgResults;
	}
}

function InitializeForumBulkActions( strName )
{
	var $ForumArea = $J('#forum_' + strName + '_area' );
	var $ForumActions = $J('#forum_' + strName + '_bulk_actions' );
	var $BtnEnable = $J('#forum_' + strName + '_bulk_enable');
	var $BtnDisable = $J('#forum_' + strName + '_bulk_disable');

	var $BtnDelete = $J('#forum_' + strName + '_bulk_delete');
	var $BtnUnDelete = $J('#forum_' + strName + '_bulk_undelete');
	var $BtnMarkSpam = $J('#forum_' + strName + '_bulk_markspam');
	var $BtnBanCommenters = $J('#forum_' + strName + '_bulk_bancommenters');

	var $BtnLock = $J('#forum_' + strName + '_bulk_lock');
	var $BtnUnLock = $J('#forum_' + strName + '_bulk_unlock');

	var $BtnMove = $J('#forum_' + strName + '_bulk_move');
	var $BtnMerge = $J('#forum_' + strName + '_bulk_merge');

	var $BtnPurge = $J('#forum_' + strName + '_bulk_purge');

	var $OtherPagesWarning = $J('#forum_' + strName + '_bulk_otherpages').hide();
	var $OtherPagesCount = $J('#forum_' + strName + '_bulk_otherpage_count');
	var $OtherPagesClear = $J('#forum_' + strName + '_bulk_otherpage_clear');

	if ( !$ForumActions.length )
		return;

	var bEnabled = false;
	var rgAllSelectedTopics = {};
	var cTopicsCheckedOnOtherPages = 0;

	var $BtnShowDefault = $J().add( $BtnDelete ).add( $BtnLock ).add( $BtnMove ).add( $BtnMerge ).add( $BtnMarkSpam ).add( $BtnBanCommenters );
	var $BtnHideDefault = $J().add( $BtnUnDelete ).add( $BtnUnLock ).add( $BtnPurge );

	var fnShowControlsIfCheckboxChecked = function ()
	{
		var $CheckedBoxes = $ForumArea.find( '.forum_topic_checkbox_input:checked' );

		$BtnShowDefault.show();
		$BtnHideDefault.hide();

		if ( cTopicsCheckedOnOtherPages > 0 )
		{
			$OtherPagesWarning.show();
			$OtherPagesCount.text( cTopicsCheckedOnOtherPages );
			if ( cTopicsCheckedOnOtherPages == 1 )
			{
				$OtherPagesWarning.children( '.bulk_otherpages_single' ).show();
				$OtherPagesWarning.children( '.bulk_otherpages_multi' ).hide();
			}
			else
			{
				$OtherPagesWarning.children( '.bulk_otherpages_single' ).hide();
				$OtherPagesWarning.children( '.bulk_otherpages_multi' ).show();
			}
		}
		else
		{
			$OtherPagesWarning.hide();
		}

		if ( $CheckedBoxes.length > 0 || cTopicsCheckedOnOtherPages )
		{
			var $CheckedTopics = $CheckedBoxes.parents( '.forum_topic' );
			var cTotalTopics = 0;
			var cDeletedTopics = 0;//$CheckedTopics.filter( '.deleted' ).length;
			var cLockedTopics = 0;//$CheckedTopics.filter( '.locked' ).length;
			var cMovedTopics = 0;

			for ( var gidTopic in rgAllSelectedTopics )
			{
				cTotalTopics++;
				if ( rgAllSelectedTopics[gidTopic].deleted )
					cDeletedTopics++;
				if ( rgAllSelectedTopics[gidTopic].locked )
					cLockedTopics++;
				if ( rgAllSelectedTopics[gidTopic].moved )
					cMovedTopics++;
			}

			if ( cMovedTopics )
			{
				// you can only purge moved topics - remove all other commands
				$BtnShowDefault.hide();
				$BtnPurge.show();
			}
			else
			{

				if ( cDeletedTopics == cTotalTopics )
				{
					$BtnUnDelete.show();
					$BtnDelete.hide();
					$BtnMarkSpam.hide();
					$BtnBanCommenters.hide();
				}

				if ( cDeletedTopics > 0 )
				{
					// really only undelete will work on deleted topics
					$BtnMove.hide();
					$BtnMerge.hide();
					$BtnLock.hide();
					$BtnPurge.show();
				}
				else if ( cLockedTopics == cTotalTopics )
				{
					$BtnUnLock.show();
					$BtnLock.hide();
				}
			}

			$ForumActions.find('.manage_actions_buttons').fadeTo( 'fast', 1.0 );
		}
		else
		{
			$ForumActions.find('.manage_actions_buttons').fadeTo( 'fast', 0.3 );
		}
	}

	var fnAddCheckboxes = function() {

		if ( !bEnabled )
			return;

		// only include moved threads if the user can purge.  purging is the only thing you can do with a moved topic.
		var $ForumTopics = $ForumArea.find( $BtnPurge.length ? '.forum_topic' : '.forum_topic:not(.moved)' );
		cTopicsCheckedOnOtherPages = V_CountKeys( rgAllSelectedTopics );

		$ForumTopics.each( function() {
			var $ForumTopic = $J(this);

			var gidForumTopic = this.getAttribute( 'data-gidforumtopic' );
			if ( rgAllSelectedTopics[gidForumTopic] )
				cTopicsCheckedOnOtherPages--;

			if ( !$ForumTopic.hasClass( 'bulk_edit_mode' ) )
			{
				var $Checkbox = $J('<input/>', {'type': 'checkbox', 'class': 'forum_topic_checkbox_input' } );
				$Checkbox.data( 'gidForumTopic', gidForumTopic );

				$Checkbox.change( function() {
					if ( $Checkbox.prop('checked') )
					{
						$ForumTopic.addClass( 'selected_for_bulk' );
						rgAllSelectedTopics[gidForumTopic] = {
							deleted: $ForumTopic.hasClass( 'deleted' ),
							locked: $ForumTopic.hasClass( 'locked' ),
							moved: $ForumTopic.hasClass( 'moved' ),
						};
					}
					else
					{
						$ForumTopic.removeClass( 'selected_for_bulk' );
						delete rgAllSelectedTopics[gidForumTopic];
					}
					fnShowControlsIfCheckboxChecked();
				} );

				// restore the checked state
				if ( rgAllSelectedTopics[gidForumTopic] )
				{
					$Checkbox.prop( 'checked', true );
					$Checkbox.change();
				}

				var $Wrapper = $J('<div/>', {'class': 'forum_topic_checkbox' } );
				$Wrapper.html( '&nbsp;' );
				$Wrapper.prepend( $Checkbox );

				$ForumTopic.find( 'a.forum_topic_overlay').on( 'click', function( event ) {
					// only on left click, otherwise we let middle clicks open in tabs, etc
					if ( typeof event.originalEvent.button == 'undefined' || event.originalEvent.button == 0 )
					{
						$Checkbox.prop( 'checked', function( i, val ) { return !val; } );
						$Checkbox.change();
						event.preventDefault();
					}
				} );

				$ForumTopic.prepend( $Wrapper );
				$ForumTopic.addClass( 'bulk_edit_mode' );

			}
		});

		fnShowControlsIfCheckboxChecked();
	};

	var fnClearAllSelections = function() {
		rgAllSelectedTopics = {};
		cTopicsCheckedOnOtherPages = 0;
		$ForumArea.find( '.forum_topic_checkbox_input:checked').each( function() {
			$J(this).prop( 'checked', false ).change();
		} );
		fnShowControlsIfCheckboxChecked();
	};

	$OtherPagesClear.click( fnClearAllSelections );


	$BtnEnable.click( function() {
		bEnabled = true;
		$ForumActions.slideDown( 'fast' );
		fnAddCheckboxes();

		$BtnEnable.hide();
		$BtnDisable.show();
	});
	$BtnDisable.click( function() {
		bEnabled = false;
		$ForumActions.slideUp( 'fast' );
		$ForumArea.find( '.forum_topic').removeClass('selected_for_bulk').removeClass( 'bulk_edit_mode');
		$ForumArea.find( '.forum_topic').children( '.forum_topic_checkbox').detach();
		$ForumArea.find( '.forum_topic a.forum_topic_overlay').off( 'click' );

		$BtnEnable.show();
		$BtnDisable.hide();
	});

	$BtnDelete.click( function() { ForumBulkDelete( strName, V_Keys( rgAllSelectedTopics ) ); } );
	$BtnUnDelete.click( function() { ForumBulkDelete( strName, V_Keys( rgAllSelectedTopics ), true ); } );
	$BtnMarkSpam.click( function() { ForumBulkSpam( strName, V_Keys( rgAllSelectedTopics ) ); } );
	$BtnBanCommenters.click( function() { ForumBulkBanCommenters( strName, V_Keys( rgAllSelectedTopics ) ); } );

	$BtnLock.click( function() { ForumBulkLock( strName, V_Keys( rgAllSelectedTopics ) ); } );
	$BtnUnLock.click( function() { ForumBulkLock( strName, V_Keys( rgAllSelectedTopics ), true ); } );

	$BtnMove.click( function() { ForumBulkMove( strName, V_Keys( rgAllSelectedTopics ) ).done( fnClearAllSelections ); } );
	$BtnMerge.click( function() { ForumBulkMerge( strName, V_Keys( rgAllSelectedTopics ) ).done( fnClearAllSelections ); } );

	$BtnPurge.click( function() { ForumBulkPurge( strName, V_Keys( rgAllSelectedTopics ), fnClearAllSelections ); } );

	//prototype AJAX
	Ajax.Responders.register( { onComplete: fnAddCheckboxes } );
}

function ForumBulkDelete( strName, rgForumTopicGIDs, bUndelete )
{
	BulkModerate( strName, rgForumTopicGIDs, 'deleted', !bUndelete)
		.done( function( data ) {
			if ( bUndelete )
				ShowAlertDialog( 'H???y x??a', 'Ch??? ????? ???????c l???a ch???n ???? ???????c kh??i ph???c.' );
			else
				ShowAlertDialog( 'X??a', 'Ch??? ????? ???????c l???a ch???n ???? b??? x??a.' );
		});
}

function ForumBulkLock( strName, rgForumTopicGIDs, bUnlock )
{
	BulkModerate( strName, rgForumTopicGIDs, 'locked', !bUnlock)
		.done( function( data ) {
			if ( bUnlock )
				ShowAlertDialog( 'M??? kh??a', 'Nh???ng ch??? ????? ???????c ch???n ???? ???????c m??? kh??a.' );
			else
				ShowAlertDialog( 'Kh??a', 'Nh???ng ch??? ????? ???????c ch???n ???? ???????c kh??a.' );
		});
}

function ForumBulkMove( strName, rgForumTopicGIDs )
{
	return BulkModerate( strName, rgForumTopicGIDs, 'movetopic' )
		.done( function( transport ) {
			// the transport is from prototype
			ShowAlertDialog( 'Di chuy???n', 'Ch??? ????? ???????c l???a ch???n ???? ???????c chuy???n ?????n di???n ????n m???i.' );
		});
}

function ForumBulkMerge( strName, rgForumTopicGIDs )
{
	return BulkModerate( strName, rgForumTopicGIDs, 'mergetopics' )
		.done( function( transport ) {
			// the transport is from prototype
			var strNewURL = '';
			if ( transport && transport.responseJSON && transport.responseJSON.newtopic )
				strNewURL = transport.responseJSON.newtopic;

			if ( strNewURL )
			{
				ShowConfirmDialog(
					'K???t h???p ch??? ?????',
					'Ch??? ????? ???????c l???a ch???n ???? ???????c s??p nh???p v??o m???t ch??? ????? duy nh???t.',
					'T???i ch??? ????? ???? g???p',
					'OK'
				).done( function() {
						window.location = strNewURL;
					});
			}
			else
			{
				// don't have a URL?
				ShowAlertDialog('K???t h???p ch??? ?????',
					'Ch??? ????? ???????c l???a ch???n ???? ???????c s??p nh???p v??o m???t ch??? ????? duy nh???t.' );
			}
		} );
}

function ForumBulkPurge( strName, rgForumTopicGIDs, fnOnComplete )
{
	ShowConfirmDialog('X??a v??nh vi???n ',
		'B???n c?? ch???c mu???n x??a ch??? ????? n??y v??nh vi???n? H??nh ?????ng n??y kh??ng th??? ho??n t??c ???????c.',
		'X??a v??nh vi???n'
	).done ( function() {
		BulkModerate( strName, rgForumTopicGIDs, 'purge', true )
		.done( function( data ) {
			ShowAlertDialog( 'X??a v??nh vi???n', 'Ch??? ????? ???????c ch???n ???? b??? x??a v??nh vi???n.' );
			fnOnComplete();
		});
	});
}

function ForumBulkSpam( strName, rgForumTopicGIDs )
{
	ShowConfirmDialog('????nh d???u spam ',
		'H??nh ?????ng n??y s??? x??a c??c ch??? ????? ???? ch???n v?? c???m t??c gi??? kh???i di???n ????n. B???n c?? ch???c mu???n th???c hi???n?',
		'X??a spam'
	).done ( function() {
	BulkModerate( strName, rgForumTopicGIDs, 'markspam', true )
		.done( function( data ) {
			ShowAlertDialog( '????nh d???u spam', 'Ch??? ????? ???????c ch???n ???? b??? x??a v?? ng?????i t???o n?? ???? b??? c???m.' );
		});
});
}

function ForumBulkBanCommenters( strName, rgForumTopicGIDs )
{
	ShowConfirmDialog('C???m ng?????i b??nh lu???n ',
	'H??nh ?????ng n??y s??? ban h??nh m???t l???nh c???m c???ng ?????ng (ho???c ????nh d???u hijack l???c ?????) cho ng?????i d??ng ???? b??nh lu???n nhi???u h??n m???t m???c ?????nh ra tr??n c??c ch??? ????? ???????c ch???n. B???n c?? ch???c m??nh mu???n l??m nh?? th??? kh??ng?',
	'C???m ng?????i b??nh lu???n'
).done ( function() {
	BulkModerate( strName, rgForumTopicGIDs, 'bancommenters', true )
		.done( function( data ) {
			ShowAlertDialog( 'C???m ng?????i b??nh lu???n', 'Nh???ng ng?????i d??ng n??y b??? c???m do ???? b??nh lu???n tr??n h???n m???c trong c??c ch??? ????? ???????c ch???n.' );
		});
});
}


function BulkModerate( strName, rgForumTopicGIDs, flag, value )
{
	var Forum = g_rgForums[strName];
	var $ForumArea = $J('#forum_' + strName + '_area' );

	if ( rgForumTopicGIDs.length == 0 )
	{
		return $J.Deferred();
	}
	var bResolveReports = $J('#forum_' + strName + '_bulk_resolve_reports').prop('checked');

	if ( flag == 'movetopic' )
	{
		deferred = Forum_MoveTopics( Forum.GetActionURL( 'movetopic' ), Forum.m_rgForumData, rgForumTopicGIDs, bResolveReports );
		deferred.always( function() { hideModal( 'forum_modal' ); } );	//hide the old crufty modal
	}
	else if ( flag == 'mergetopics' )
	{
		deferred = Forum_MergeTopicDialog( Forum.GetActionURL( 'mergetopics' ), Forum.m_rgForumData, rgForumTopicGIDs, bResolveReports );
	}
	else
	{
		var strURL = Forum.GetActionURL( 'moderatetopic' );
		var rgParams = {
			sessionid: g_sessionID,
			action: 'setflag',
			flag: flag,
			value: value,
			gidforumtopic_list: V_ToJSON( rgForumTopicGIDs ),
			resolve_reports: (bResolveReports ? '1' : '')
		};
		var deferred =  $J.ajax( strURL, {
			data: rgParams,
			type: 'POST'
		});
	}

	return deferred.fail( function() {
		ShowAlertDialog( 'L???i', '???? c?? l???i x???y ra trong qu?? tr??nh x??? l?? t???t c??? ho???c m???t ph???n y??u c???u c???a b???n. Xin vui l??ng x??c minh r???ng b???n ???? ???????c nh???n k???t qu??? mong ?????i.' );
	}).always( function() {
		Forum.ReloadCurrentPage();
	});
}


function StartTradeOfferForTradingTopic( unAccountID, unClanIDOwner, gidTopic )
{
	var params = {};
	params['partner'] = unAccountID;
	params['forum_owner'] = unClanIDOwner;
	params['forum_topic'] = gidTopic;
	ShowTradeOffer( 'new', params );
}

function Forum_InitExpiryOptions( $Select )
{
	var nLastExpiryChoice = WebStorage.GetLocal( 'nForumLastExpiryChoice', false ) || 0;
	$Select.val( nLastExpiryChoice );

	$Select.off( 'change.ForumRememberChoice' );
	$Select.on( 'change.ForumRememberChoice', function() {
		WebStorage.SetLocal( 'nForumLastExpiryChoice', $Select.val() );
	});
}

function Forum_InitBanLengthOptions( $Select )
{
	var nLastBanLengthChoice = WebStorage.GetLocal( 'nForumLastBanLengthChoice', false ) || 0;
	$Select.val( nLastBanLengthChoice );

	$Select.off( 'change.ForumRememberChoice' );
	$Select.on( 'change.ForumRememberChoice', function() {
		WebStorage.SetLocal( 'nForumLastBanLengthChoice', $Select.val() );
	});
}


function Forum_BanOrWarnUser( clanid, gidForum, gidTopic, gidComment, accountIDTarget, bWarning )
{
	var $WaitElem = $J('<div/>', {'class': 'forum_banuser_modal_wait'}).append( '<img src="https://community.akamai.steamstatic.com/public/images/login/throbber.gif">' );

	if ( bWarning ) {
		var Modal = ShowConfirmDialog( 'C???nh c??o ng?????i d??ng', $WaitElem, 'C???nh c??o ng?????i d??ng' );
	} else {
		var Modal = ShowConfirmDialog( 'C???m ng?????i d??ng', $WaitElem, 'C???m ng?????i d??ng' );
	}

	Modal.GetContent().find('.newmodal_buttons').css( 'visibility', 'hidden' );
	Modal.GetContent().css('width', '600px');

	$J.get( 'https://steamcommunity.com/gid/' + clanid + '/banwarnuserdialog', {
		ajax: 1,
		gidforum: gidForum,
		gidtopic: gidTopic,
		gidcomment: gidComment,
		target: accountIDTarget,
		warning: bWarning
	}).done( function( data ) {
		Modal.GetContent().find('.newmodal_buttons').css( 'visibility', '' );
		var $Content = $J(data);
		$WaitElem.replaceWith( $Content );
		Modal.AdjustSizing();

		var $Form = $Content.find( 'form#forum_banuser_form' );
		if ( !bWarning )
		{
			Forum_InitBanLengthOptions( $Form.find('select[name=ban_length]') );

			Modal.done( function() {
				var bDelete = $Form[0].elements.deletecomments && $Form[0].elements.deletecomments.checked;
				var bKick = $Form[0].elements.kickmember && $Form[0].elements.kickmember.checked;

				if ( $Form[0].elements.ban_length.value < 0 && !bDelete && !bKick )
				{
					ShowAlertDialog( 'C???m ng?????i d??ng', 'Ph???i c?? ??t nh???t m???t l???a ch???n. Ng?????i d??ng ???? kh??ng b??? c???m.' );
				}
				else
				{
					$J.post(
						'https://steamcommunity.com/gid/' + clanid + '/banuser/?ajax=1', $Form.serialize()
					).done( function( ban_response ) {
						ShowAlertDialog( 'C???m ng?????i d??ng', ban_response.message ? ban_response.message : 'Quy???n ????ng v?? ch???nh s???a c???a ng?????i d??ng n??y ???? b??? thu h???i.' );
					}).fail( function( jqxhr ) {
						var ban_response = V_ParseJSON( jqxhr.responseText );
						ShowAlertDialog( 'C???m ng?????i d??ng', ban_response.message ? ban_response.message : 'B???n kh??ng c?? quy???n c???m ng?????i d??ng. Xin vui l??ng x??c th???c l???i quy???n h??nh t??i kho???n c???a b???n ho???c th??? l???i sau.' );
					});
				}
			});
		}
		else
		{
			Modal.done( function() {

				$J.post(
					'https://steamcommunity.com/gid/' + clanid + '/banuser/?ajax=1', $Form.serialize()
				).done( function( ban_response ) {
					ShowAlertDialog( 'C???nh c??o ng?????i d??ng', ban_response.message ? ban_response.message : '???? c???nh c??o th??nh c??ng ng?????i d??ng n??y v?? b??i vi???t c???a h???.' );
				}).fail( function( jqxhr ) {
					var ban_response = V_ParseJSON( jqxhr.responseText );
					ShowAlertDialog( 'C???nh c??o ng?????i d??ng', ban_response.message ? ban_response.message : 'Ch??ng t??i g???p ph???i l???i khi c???nh c??o ng?????i d??ng n??y, vui l??ng th??? l???i sau.' );
				});
			});
		}

	}).fail( function() {
		Modal.Dismiss();
		if ( !bWarning ) {
			ShowAlertDialog( 'C???m ng?????i d??ng', 'B???n kh??ng c?? quy???n c???m ng?????i d??ng. Xin vui l??ng x??c th???c l???i quy???n h??nh t??i kho???n c???a b???n ho???c th??? l???i sau.' );
		}
		else {
			ShowAlertDialog( 'C???nh c??o ng?????i d??ng', 'Ch??ng t??i g???p ph???i l???i khi c???nh c??o ng?????i d??ng n??y, vui l??ng th??? l???i sau.' );
		}
	});
}

function Forum_SendPM( clanid, gidForum, gidTopic, gidComment, accountIDTarget )
{
	var $strDialogHTML = '<div class="private_message_dialog_instructions" >' + 'Vui l??ng nh???p tin nh???n b???n mu???n g???i ri??ng cho ng?????i d??ng n??y:' + '</div><div class="fullwidth gray_bevel"><textarea class="forumtopic_reply_textarea" rows="3" name="pm_text" id="pm_text" ></textarea></div><div class="private_message_dialog_footnote">*B??i vi???t n??y s??? t??? ?????ng li??n k???t t???i tin nh???n ri??ng c???a b???n.</div>';

	var $modal = ShowConfirmDialog( 'Tin nh???n ri??ng', $strDialogHTML, 'G???i tin nh???n ri??ng' );
	$modal.GetContent().css('width', '600px');

	var elMessage = $modal.GetContent().find('#pm_text');

	$modal.done( function( ) {

		var rgParams = {
			gidforum: gidForum,
			gidtopic: gidTopic,
			gidcomment: gidComment,
			target: accountIDTarget,
			message: elMessage.val(),
			sessionid: g_sessionID
		};

		$J.post('https://steamcommunity.com/gid/' + clanid + '/sendprivatemessage/', rgParams )
			.done( function ( response ) {
				if ( response.success == 1 )
				{
					ShowAlertDialog( 'Tin nh???n ri??ng', response.message );
				}
				else
				{
					ShowAlertDialog( 'L???i', '???? c?? l???i x???y ra trong khi g???i tin nh???n ri??ng. Vui l??ng th??? l???i sau.' + '(' + response.success + ')' );
				}
			});
	} );

}

function Forum_OnSearchSortSelect( elSelect, rgSearchParams )
{
	if ( !rgSearchParams || typeof( rgSearchParams.length ) != 'undefined' )
		rgSearchParams = {};

	var opt = $J(elSelect).val();
	if ( opt == 'relevance' )
		delete rgSearchParams['sort'];
	else
		rgSearchParams['sort'] = opt;

	window.location.search = $J.param( rgSearchParams );
}

function IssueCommunityWarning( steamid )
{
	$J.get( 'https://steamcommunity.com/actions/modwarningdialog', { 'sessionID' : g_sessionID, 'steamID' : steamid } )
		.done( function( data )
		{
			var $Content = $J(data);
			var Modal = ShowConfirmDialog( "Issue Warning", $Content, 'Issue Warning'
			).done(	function( ) {

				var $Form = $Content.find( 'form#modWarning_Form' );

				$J.post( "https://steamcommunity.com/actions/issuemodwarning", $Form.serialize() )
					.done( function( data ) {
						ShowAlertDialog( 'Success', 'Warning issued successfully! You can <a href=https://steamcommunity.com/profiles/' + steamid + '/moderatormessages/' + data.messageid + ' target="_blank" >view it here</a>.' );
					}).fail( function( jqxhr ) {
					// jquery doesn't parse json on fail
					var data = V_ParseJSON( jqxhr.responseText );
					ShowAlertDialog( 'Issue Warning', 'Failed with error message: ' + data.success );
				});
			} );

		}).fail( function( data )
	{
		ShowAlertDialog( 'ERROR', 'You do not have permissions to view this or you are not logged in.' );
	});
}

$J( function($) {
	Forum_InitPostAndCommentControls();
});

