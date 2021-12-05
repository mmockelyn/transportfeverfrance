
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
			var strMessage = 'Hvis personverninnstillingene dine for lageret er satt til offentlig, vil samfunnsmedlemmer kunne sende deg byttetilbud fra denne tråden.';
			if ( this.m_rgCreateTopicFlags.inventory_public )
				strMessage = '<b>Personverninnstillingene dine for lageret er satt til Offentlig</b>. Dette betyr at samfunnsmedlemmer kan sende deg byttetilbud fra denne tråden. Hvis personverninnstillingene dine for lageret er satt til noe annet enn Offentlig, kan du ikke motta byttetilbud i Samfunnet.';
			else if ( typeof this.m_rgCreateTopicFlags.inventory_public != 'undefined' )
				strMessage = '<b>Ditt lagers personverninnstillinger er <u>ikke</u> satt til "Offentlig"</b>. Dette betyr at medlemmer ikke kan sende deg bytteforespørsler fra dette emnet. Hvis lagerets personverninnstillinger var "Offentlig", ville medlemmer hatt muligheten til å sende deg bytteforespørsler fra denne tråden.';

			strMessage += '<div class="forum_newtopic_info_rule"></div>';
			strMessage += '<img class="forum_newtopic_info_trade_closebuttondemo" src="https://community.akamai.steamstatic.com/public/images/skin_1/forum_img_closetopic.png">';
			strMessage += 'Når du er ferdig med å motta byttetilbud eller du har gjennomført byttet, kan du stenge denne tråden og forby byttetilbud herfra.';
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
		$('forum_' + this.m_strName + '_newtopic_error' ).update( 'Det oppstod en feil ved forsøk på å skape et nytt emne:' + ( rgJSON.error ? rgJSON.error : rgJSON.success ) );
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
			onFailure: function() { ShowForumSuccessDialogWithDetailTitle( 'Abonner på forum', 'Det oppstod en feil under abonnering på dette forumet.', 'Prøv igjen senere.' ); },
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
			onFailure: function() { ShowForumSuccessDialogWithDetailTitle( 'Opphev abonnement på forum', 'Det oppstod en feil under oppheving av abonnementet på dette forumet.', 'Prøv igjen senere.' ); },
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
			ShowConfirmDialog('Slett tråd ',
				'Er du sikker på at du vil slette denne tråden? ' +
				'Denne handlingen kan bare omgjøres av en moderator.',
				'Slett tråd'
			).done( function() {
					Topic.Delete();
				});
		}
	}
}

function Forum_PurgeTopic( gidTopic )
{
	ShowConfirmDialog('Slett permanent ',
		'Er du sikker på at du ønsker å permanent slette dette emnet? Dette kan ikke angres.',
		'Slett permanent'
	).done( function() {
		Forum_SetTopicFlag( gidTopic, 'purge', true );
	});
}


function Forum_ClearContentCheckResult( gidTopic )
{
	ShowConfirmDialog('Fjern merket «Forbudt innhold» ',
		'Er du sikker på at du vil fjerne merket for forbudt innhold på emnet? Dette kan ikke angres.',
		'Fjern merket «Forbudt innhold»'
	).done( function() {
		Forum_SetTopicFlag( gidTopic, 'clearcontentcheckresult', true );
	});
}

function Forum_BanCommenters( gidTopic )
{
	ShowConfirmDialog('Utesteng kommentatorer ',
	'Er du sikker på at du vil utestenge brukerne som har kommentert over 5 ganger i dette emnet? Det blir vanskelig å gjøre om denne handlingen.',
	'Utesteng kommentatorer'
).done( function() {
	Forum_SetTopicFlag( gidTopic, 'bancommenters', true );
});
}

function Forum_MarkSpam( gidTopic )
{
	ShowConfirmDialog('Marker som søppelpost ',
		'Dette vil slette de valgte trådene og utestenge forfatterne fra forumet. Er du sikker på at du vil gjøre dette?',
		'Slett søppelpost'
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
						'Slå sammen emner',
						'De valgte trådene er blitt slått sammen til en enkelt tråd.',
						'Gå til det sammenslåtte emnet',
						'Tilbake til emneliste'
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
	ShowConfirmDialog( 'Lås dette emnet', 'Å merke denne tråden som "Stengt" vil forhindre noen flere svar eller byttetilbud i den. Når den er stengt vil du ikke kunne utføre noen flere handlinger med den.', 'Lås dette emnet')
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
			'Rapporter dette innlegget',
			$ReportModalContent.show(),
			'Rapporter'
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
		ShowForumSuccessDialogWithDetailTitle( 'Rapporter', 'Takk for din rapport', 'Rapporten er blitt sendt til moderatorene for gjennomgang. Vi gir deg beskjed dersom vi iverksetter tiltak.' );
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
			ShowForumSuccessDialog( '', 'Kunne ikke redigere emnet. Feilmelding:' +
			 "<br><br>" + transport.responseJSON.msg );
		}
		else
		{
			ShowForumSuccessDialog( '', 'Kunne ikke endre emnet. Prøv igjen senere.' );
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
				ShowForumSuccessDialogWithDetailTitle( 'Abonner på diskusjon', 'Du abonnerer nå på denne diskusjonen.', 'Du vil motta et kommentarvarsel når noen svarer i denne diskusjonen.' );
				fnExternalOnSuccess();
			};
			var fnFail = ShowForumSuccessDialog.bind( null, 'Abonner på diskusjon', 'Beklager, vi kunne ikke abonnere på denne diskusjonen. Prøv igjen senere.');
			g_rgForumTopicCommentThreads[ this.m_gidForumTopic ].Subscribe( fnSuccess, fnFail );
		}
	},

	Unsubscribe: function( fnExternalOnSuccess )
	{
		if ( g_rgForumTopicCommentThreads[ this.m_gidForumTopic ] )
		{
			var fnSuccess = function() {
				ShowForumSuccessDialogWithDetailTitle( 'Opphev abonnement på diskusjon', 'Du har opphevet abonnementet fra denne diskusjonen.', 'Du vil ikke lenger motta kommentarvarsler fra denne diskusjonen.' );
				fnExternalOnSuccess();
			};
			var fnFail = ShowForumSuccessDialog.bind( null, 'Opphev abonnement på diskusjon', 'Beklager, vi kunne ikke oppheve abonnementet fra denne diskusjonen. Prøv igjen senere.');
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
					strMessage = 'Alle rapporter som assosieres med dette emnet har blitt markert som løst.<br>Antall rapporter som måtte løses:' + cReportsResolved;
				else
					strMessage = 'Alle rapporter som assosieres med dette emnet har allerede blitt merket som løst.';

				ShowForumSuccessDialogWithDetailTitle( 'Løs rapporterte innlegg', 'Rapporter løst.', strMessage );
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
			ShowAlertDialog( 'Innleggslogg', data );
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
			ShowConfirmDialog( '', 'Er du sikker på at du vil slette dette innlegget?', 'Slett' )
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
	{value: 0, label: 'Ingen viderekobling' },
	{value: 1, label: '1 time' },
	{value: 24, label: '1 dag' },
	{value: 168, label: '1 uke' },
	{value: 720, label: '1 måned' },
	{value: -1, label: 'Permanent' }
];
function Forum_MergeTopicDialog( strActionURL, rgForumData, rgForumTopics, bResolveReports )
{
	var $DialogContent = $J('<div/>', {'class': 'merge_topic_dialog'} );
	var $MergeForm = $J('<form/>' );
	$DialogContent.append( $MergeForm );

	var strMessage = 'Sammenslåing av emner vil flytte alle innlegg fra en eller flere emner inn i et annet emne. Dersom det allerede finnes innlegg i målemnet, vil nye innlegg bli satt etter hverandre i den rekkefølgen de ble publisert. Dette kan ikke angres.<br><br>';
	strMessage += rgForumTopics.length > 1 ? 'Velg en nylig sett tråd å slå de valgte trådene sammen med:' : 'Velg en nylig sett tråd å slå denne tråden sammen med:';

	$MergeForm.append( $J('<div/>', {'class': 'merge_topic_dialog_content' }).html( strMessage ) );

	var $List = $J('<div/>', {'class': 'merge_topic_target_list' } );
	$MergeForm.append( $List );

	var strMoreInstructions = 'Hvis tråden du vil slå sammen med en annen ikke er oppført her, <%1$s>kan du lete etter den tråden du vil ha<%2$s> i et nytt vindu. Denne listen vil bli oppdatert automatisk når du kommer tilbake.'.replace( /%1\$s/, 'a class="whiteLink" href="' + rgForumData.forum_url + '" target="_blank"').replace( /%2\$s/, '/a' );
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
	$Expiry.append( 'Etterlat omdirigering for: ', $Select );
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
			var $MergeTogether = fnMakeMergeOption( 0, 0, 0, 'Slå sammen de valgte trådene med den eldste tråden.' );
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

	var Modal = ShowConfirmDialog( 'Slå sammen emner', $DialogContent, 'Slå sammen emner' );
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
				ShowAlertDialog( 'Angre sletting', 'De valgte trådene er blitt gjenopprettet.' );
			else
				ShowAlertDialog( 'Slett', 'De valgte trådene er blitt slettet.' );
		});
}

function ForumBulkLock( strName, rgForumTopicGIDs, bUnlock )
{
	BulkModerate( strName, rgForumTopicGIDs, 'locked', !bUnlock)
		.done( function( data ) {
			if ( bUnlock )
				ShowAlertDialog( 'Lås opp', 'De valgte trådene er blitt låst opp.' );
			else
				ShowAlertDialog( 'Lås', 'De valgte trådene er blitt låst.' );
		});
}

function ForumBulkMove( strName, rgForumTopicGIDs )
{
	return BulkModerate( strName, rgForumTopicGIDs, 'movetopic' )
		.done( function( transport ) {
			// the transport is from prototype
			ShowAlertDialog( 'Flytt …', 'De valgte trådene er blitt flyttet til det nye forumet.' );
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
					'Slå sammen emner',
					'De valgte trådene er blitt slått sammen til en enkelt tråd.',
					'Gå til det sammenslåtte emnet',
					'OK'
				).done( function() {
						window.location = strNewURL;
					});
			}
			else
			{
				// don't have a URL?
				ShowAlertDialog('Slå sammen emner',
					'De valgte trådene er blitt slått sammen til en enkelt tråd.' );
			}
		} );
}

function ForumBulkPurge( strName, rgForumTopicGIDs, fnOnComplete )
{
	ShowConfirmDialog('Slett permanent ',
		'Er du sikker på at du ønsker å permanent slette dette emnet? Dette kan ikke angres.',
		'Slett permanent'
	).done ( function() {
		BulkModerate( strName, rgForumTopicGIDs, 'purge', true )
		.done( function( data ) {
			ShowAlertDialog( 'Slett permanent', 'De valgte trådene er blitt permanent slettet.' );
			fnOnComplete();
		});
	});
}

function ForumBulkSpam( strName, rgForumTopicGIDs )
{
	ShowConfirmDialog('Marker som søppelpost ',
		'Dette vil slette de valgte trådene og utestenge forfatterne fra forumet. Er du sikker på at du vil gjøre dette?',
		'Slett søppelpost'
	).done ( function() {
	BulkModerate( strName, rgForumTopicGIDs, 'markspam', true )
		.done( function( data ) {
			ShowAlertDialog( 'Marker som søppelpost', 'De valgte trådene er blitt slettet og forfatterne er utestengte.' );
		});
});
}

function ForumBulkBanCommenters( strName, rgForumTopicGIDs )
{
	ShowConfirmDialog('Utesteng kommentatorer ',
	'Dette gir en samfunnsutestengelse til brukerne (eller markerer dem som stjålet) som har kommentert over et visst antall ganger i de valgte trådene. Er du sikker på at du vil fortsette?',
	'Utesteng kommentatorer'
).done ( function() {
	BulkModerate( strName, rgForumTopicGIDs, 'bancommenters', true )
		.done( function( data ) {
			ShowAlertDialog( 'Utesteng kommentatorer', 'Brukerne som har kommentert over grensen i de valgte emnene, er blitt utestengte.' );
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
		ShowAlertDialog( 'Feil', 'Det oppstod en feil med behandlingen av hele eller deler av forespørselen. Bekreft at du fikk de ønskede resultatene.' );
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
		var Modal = ShowConfirmDialog( 'Advar bruker', $WaitElem, 'Advar bruker' );
	} else {
		var Modal = ShowConfirmDialog( 'Utesteng bruker', $WaitElem, 'Utesteng bruker' );
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
					ShowAlertDialog( 'Utesteng bruker', 'Minst ett alternativ må velges. Brukeren har ikke blitt utestengt.' );
				}
				else
				{
					$J.post(
						'https://steamcommunity.com/gid/' + clanid + '/banuser/?ajax=1', $Form.serialize()
					).done( function( ban_response ) {
						ShowAlertDialog( 'Utesteng bruker', ban_response.message ? ban_response.message : 'Brukerens rettigheter til å poste og redigere har blitt inndratt.' );
					}).fail( function( jqxhr ) {
						var ban_response = V_ParseJSON( jqxhr.responseText );
						ShowAlertDialog( 'Utesteng bruker', ban_response.message ? ban_response.message : 'Du har kanskje ikke tillatelse til å utestenge brukere. Sjekk kontoens tillatelser eller prøv igjen senere.' );
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
					ShowAlertDialog( 'Advar bruker', ban_response.message ? ban_response.message : 'Denne brukeren er advart for innlegget sitt.' );
				}).fail( function( jqxhr ) {
					var ban_response = V_ParseJSON( jqxhr.responseText );
					ShowAlertDialog( 'Advar bruker', ban_response.message ? ban_response.message : 'Det oppstod en feil da brukeren skulle advares, prøv igjen senere.' );
				});
			});
		}

	}).fail( function() {
		Modal.Dismiss();
		if ( !bWarning ) {
			ShowAlertDialog( 'Utesteng bruker', 'Du har kanskje ikke tillatelse til å utestenge brukere. Sjekk kontoens tillatelser eller prøv igjen senere.' );
		}
		else {
			ShowAlertDialog( 'Advar bruker', 'Det oppstod en feil da brukeren skulle advares, prøv igjen senere.' );
		}
	});
}

function Forum_SendPM( clanid, gidForum, gidTopic, gidComment, accountIDTarget )
{
	var $strDialogHTML = '<div class="private_message_dialog_instructions" >' + 'Skriv inn den private meldingen som du vil sende til denne brukeren:' + '</div><div class="fullwidth gray_bevel"><textarea class="forumtopic_reply_textarea" rows="3" name="pm_text" id="pm_text" ></textarea></div><div class="private_message_dialog_footnote">*Dette innlegget blir automatisk henvist til i din private melding.</div>';

	var $modal = ShowConfirmDialog( 'Privat melding', $strDialogHTML, 'Send privat melding' );
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
					ShowAlertDialog( 'Privat melding', response.message );
				}
				else
				{
					ShowAlertDialog( 'Feil', 'Det oppstod en feil da denne private meldingen skulle sendes. Prøv igjen.' + '(' + response.success + ')' );
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
