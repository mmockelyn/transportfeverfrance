
function CreateDateRangeInput( container, id )
{
	var sourceInput = $J( id );
	var dateObj = new Date( sourceInput.val() * 1000 );
	var dateOptions = { day: 'numeric', month: 'long', year: 'numeric', timeZone: 'UTC' };
	var dateString = dateObj.toLocaleDateString( undefined, dateOptions );
	var input = $J( '<input/>', { type: 'input', class: 'date_range_filter_input', value: sourceInput.val() == 0 ? '' : dateString } );
	container.append( input );

	input.datepicker( {
		dateFormat: '@',
		showOtherMonths: true,
		changeMonth: true,
		changeYear: true,
		maxDate: "+1d",
		defaultDate: sourceInput.val() != 0 ? dateObj : null,
		onSelect: function( newDate, instance ) {
			var dateObj = new Date( parseInt( newDate ) );
			var dateOptions = { day: 'numeric', month: 'long', year: 'numeric', timeZone: 'UTC' };
			var dateString = dateObj.toLocaleDateString( undefined, dateOptions );
			$J( this ).val( dateString );
		}
	} );

	return input;
}

function ShowDateRangeSelectionDialog()
{
	var content = $J( '<div/>', { class: 'date_range_filter_dialog' } );

	content.append( $J( '<div/>', { class: 'title', text: '게시일' } ) );
	var createdContainer = $J( '<div/>', { class: 'date_range_filter_dates' } );
	createdContainer.append( $J( '<div/>', { class: 'date_range_word', text: '기간' } ) );
	var created_date_range_start = CreateDateRangeInput( createdContainer, "#created_date_range_filter_start" );
	createdContainer.append( created_date_range_start );
	createdContainer.append( $J( '<div/>', { class: 'date_range_word', text: '~' } ) );
	var created_date_range_end = CreateDateRangeInput( createdContainer, "#created_date_range_filter_end" );
	createdContainer.append( created_date_range_end );
	content.append( createdContainer );

	content.append( $J( '<div/>', { class: 'title', text: '마지막 업데이트된 날짜'} ) );
	var updatedContainer = $J( '<div/>', { class: 'date_range_filter_dates' } );
	updatedContainer.append( $J( '<div/>', { class: 'date_range_word', text: '기간' } ) );
	var updated_date_range_start = CreateDateRangeInput( updatedContainer, "#updated_date_range_filter_start" );
	updatedContainer.append( updated_date_range_start );
	updatedContainer.append( $J( '<div/>', { class: 'date_range_word', text: '~' } ) );
	var update_date_range_end = CreateDateRangeInput( updatedContainer, "#updated_date_range_filter_end" );
	updatedContainer.append( update_date_range_end );
	content.append( updatedContainer );

	var dialog = ShowConfirmDialog( '날짜로 필터링', content );
	dialog.done( function() {
		$J( '#created_date_range_filter_start' ).val( Date.parse( created_date_range_start.val() ) / 1000 );
		$J( '#created_date_range_filter_end' ).val( Date.parse(  created_date_range_end.val() ) / 1000 );
		$J( '#updated_date_range_filter_start' ).val( Date.parse(  updated_date_range_start.val() ) / 1000 );
		$J( '#updated_date_range_filter_end' ).val( Date.parse(  update_date_range_end.val() ) / 1000 );
		FilterByTags();
	} );
}

function DownloadFile( publishFileID, revision )
{
    $J.post( "https://steamcommunity.com/sharedfiles/downloadfile/?id=" + publishFileID + "&revision=" + revision )

    .done( function(response) {
        if ( response.success == 1 )
        {
            // Need to make sure the filename is set, in case there is no Content-Disposition on the result
            // So cook up an anchor, set the href and download attributes, and click it.
            // Apparently the download attribute does not work on IE. . .
            var f = $J("<a>").hide().appendTo(document.body);
            f.attr("href", response.url );
            f[0].download = response.filename;
            f[0].click();
            setTimeout( function() { f.remove() }, 0 );
        }
        else
        {
            ShowAlertDialog( 'Error', 'Unable to download file: ' + response.message );
        }
    });
}

function SharedFilesSelectApp( workshopAppURL )
{
	HideMenu( $('appselect'), $('appselect_options') );

	window.location = workshopAppURL;
}

function SharedFilesSelectTrendDayPeriod( workshopDayURL )
{
	HideMenu( $('dayselect'), $('dayselect_options') );

	window.location = workshopDayURL;
}

function DisplayErrorMessage( strMessage )
{
	$('saved_payment_info').style.display = "none";
	$('error_display').innerHTML = strMessage;
	$('error_display').style.display = 'block';
	Effect.ScrollTo( 'error_display' );

	new Effect.Highlight( 'error_display', { endcolor : '#000000', startcolor : '#ff9900' } );
}

function ValidationMarkFieldBad( elem )
{
	if ( $(elem).hasClassName( 'highlight_on_error' ) )
		new Effect.Morph( elem, {style: 'color: #FF9900', duration: 0.5 } );
	else
		new Effect.Morph( elem, {style: 'border-color: #FF9900', duration: 0.5 } )
}

function ValidationMarkFieldOk( elem )
{
	if ( $(elem).hasClassName( 'highlight_on_error' ) )
		$(elem).style.color='';
	else
		$(elem).style.borderColor = '';
}

function ReportJSError( message, e )
{
	try
	{
		if (typeof e == 'string')
    		e = new Error(e);

		DisplayErrorMessage( message + ": " + e );
	}
	catch( e )
	{
			}
}

var rgIBANCountries = {
	AD : 1,
	AT : 1,
	BE : 1,
	BA : 1,
	BG : 1,
	HR : 1,
	CY : 1,
	CZ : 1,
	DK : 1,
	EE : 1,
	FI : 1,
	FR : 1,
	DE : 1,
	GI : 1,
	GR : 1,
	HU : 1,
	IS : 1,
	IE : 1,
	IT : 1,
	LV : 1,
	LI : 1,
	LT : 1,
	LU : 1,
	MK : 1,
	MT : 1,
	MC : 1,
	ME : 1,
	NL : 1,
	NO : 1,
	PL : 1,
	PT : 1,
	RO : 1,
	SM : 1,
	RS : 1,
	SK : 1,
	SI : 1,
	ES : 1,
	SE : 1,
	CH : 1,
	TR : 1,
	GB : 1
};

function IsIBANCountry( countryCode )
{
	return rgIBANCountries[ countryCode ] != null;
}

var rgUSATaxTreaties = {
	AM :	0,
	AU :	5,
	AT :	0,
	AZ :	0,
	BD :	10,
	BB :	5,
	BY :	0,
	BE :	0,
	BG :	5,
	CA :	0,
	CN :	10,
	CY :	0,
	CZ :	0,
	DK :	0,
	EG :	15,
	EE :	10,
	FI :	0,
	FR :	0,
	DE :	0,
	GR :	0,
	HU :	0,
	IS :	0,
	IN :	15,
	ID :	10,
	IE :	0,
	IL :	10,
	IT :	0,
	JM :	10,
	JP :	0,
	KZ :	10,
	KR :	10,
	KG :	0,
	LV :	10,
	LT :	10,
	LU :	0,
	MT :	10,
	MX :	10,
	MD :	0,
	MA :	10,
	NL :	0,
	NZ :	5,
	NO :	0,
	PK :	0,
	PH :	15,
	PL :	10,
	PT :	10,
	RO :	10,
	RU :	0,
	SK :	0,
	SI :	5,
	ZA :	0,
	ES :	5,
	LK :	10,
	SE :	0,
	CH :	0,
	TJ :	0,
	TH :	5,
	TT :	0,
	TN :	15,
	TR :	10,
	TM :	0,
	UA :	10,
	GB :	0,
	US :	0,
	UZ :	0,
	VE :	10
};

function UpdateTaxRequirement()
{
	if ( $J("#tax_usa").length == 0 )
	{
		return;
	}

	try
	{
				$('tax_usa').style.display = 'none';
		$('tax_usa_treaty').style.display = 'none';
		$('tax_usa_no_treaty').style.display = 'none';

		if ( $('country').value == 'US' || $J('#uscitizen').prop('checked') )
		{
			$('tax_usa').style.display = 'block';
			return;
		}

		for ( var key in rgUSATaxTreaties )
		{
			if ( $('country').value == key )
			{
				$('tax_usa_treaty').style.display = 'block';
				return;
			}
		}

		$('tax_usa_no_treaty').style.display = 'block';
	}
	catch( e )
	{
		ReportJSError( 'Failed in UpdateTaxRequirement()', e );
	}
}

var gValidFieldAlphaNumericRegex = /^[A-Za-z0-9 &.,#'\/\-]+$/

function OnIsCompanyChange()
{
	if ( $('iscompany').checked )
	{
		$('lastnameblock').style.display = 'none';
		$J('#uscitizenblock').hide();
		$J('#uscitizen').prop( 'checked', false );
		$('firstnamelabel').innerHTML = '회사명';
	}
	else
	{
		$('lastnameblock').style.display = 'block';
		$J('uscitizenblock').show();
		$('firstnamelabel').innerHTML = '이름 (은행 기록과 같아야 함)';
	}
}

function OnUSACitizenChange()
{
	UpdateTaxRequirement();
}

function OnLoad_UserPaymentForm()
{
	OnIsCompanyChange();
	UpdateTaxRequirement();
	UpdateBankInfo();
}

function UpdateCountrySelectState()
{
	try
	{
		if ( $('country').value == 'US' )
		{
			$('state_input').style.display = 'none';
			$('state_select').style.display = 'block';
		}
		else
		{
			$('state_input').style.display = 'block';
			$('state_input').value = '';
			$('state_select').style.display = 'none';
		}
		UpdateTaxRequirement();
	}
	catch( e )
	{
		ReportJSError( 'Failed in UpdateStateSelectState()', e );
	}
}

function UpdateBankInfo()
{
	if ( $J( "#bankaccountnumberrow").length == 0 )
	{
		return;
	}

	try
	{
				$('bankaccountnumberrow').style.display = 'block';
		$('bankroutingnumberrow').style.display = 'none';
		$('bankibanrow').style.display = 'none';
		$('bankswiftrow').style.display = 'none';

		$('bankstate_input').style.display = 'none';
		$('bankstate_select').style.display = 'none';

				if ( $('bankcountry').value == 'US' )
		{
			$('bankstate_select').style.display = 'block';
			$('bankroutingnumberrow').style.display = 'block';
			$('bankroutingnumberlabel').innerHTML = '고유 식별번호';
		}
		else
		{
			$('bankstate_input').style.display = 'block';

			if ( $('bankcountry').value == 'CA' )
			{
				$('bankroutingnumberrow').style.display = 'block';
				$('bankroutingnumberlabel').innerHTML = '캐나다 등록 은행 번호';
			}
			else if ( IsIBANCountry( $('bankcountry').value ) )
			{
				$('bankibanrow').style.display = 'block';
				$('bankswiftrow').style.display = 'block';
				$('bankaccountnumberrow').style.display = 'none';
			}
			else
			{
				$('bankswiftrow').style.display = 'block';
			}
		}
	}
	catch( e )
	{
		ReportJSError( 'Failed in UpdateBankInfo()', e );
	}
}

function IsValidRequiredField( fieldName, regex )
{
	var field = $J( fieldName );
	var value = field.val();
	value = v_trim( value );
	if ( value.length == 0 )
	{
		return false;
	}

	if ( !regex.test( value ) )
	{
		return false;
	}

	field.val( value );
	return true;
}

function ValidateUserPaymentInfo( baseURL )
{
		var errorString = '';

	bOk = true;

		try
	{
		if ( $('country').value == 'US' )
		{
			$('state').value = $('state_select').value;
		}
		else
		{
			$('state').value = $('state_input').value;
		}

				if ( $J( "#firstname").length != 0 )
		{
			if ( $( 'iscompany' ).checked )
			{
				if ( !IsValidRequiredField( "#firstname", gValidFieldAlphaNumericRegex ) )
				{
					errorString += '회사 이름을 적어주세요.<br/>';
				}
				$( 'lastname' ).value = '';
			}
			else
			{
				if ( !IsValidRequiredField( "#firstname", gValidFieldAlphaNumericRegex ) )
				{
					errorString += '성씨를 올바르게 입력해 주세요.<br/>';
				}
				if ( !IsValidRequiredField( "#lastname", gValidFieldAlphaNumericRegex ) )
				{
					errorString += '성씨를 제외한 이름을 올바르게 입력해 주세요.<br/>';
				}
			}
		}

				if ( !IsValidRequiredField( "#address1", gValidFieldAlphaNumericRegex ) )
		{
			errorString += '주소를 올바르게 입력해 주세요.<br/>';
		}
		if ( !IsValidRequiredField( "#city", gValidFieldAlphaNumericRegex ) )
		{
			errorString += '도시 이름을 올바르게 입력해 주세요.<br/>';
		}
		if ( $('country').value == 'US' || $('country').value == 'UA' )
		{
			if ( !IsValidRequiredField( "#zip", gValidFieldAlphaNumericRegex ) )
			{
				errorString += '우편번호를 올바르게 입력해 주세요.<br/>';
			}
		}
		if ( $( 'phone' ).value.length < 1 )
		{
			errorString += '지역 번호를 포함한 휴대 전화 번호를 입력해주세요.<br/>';
		}
	}
	catch(e)
	{
		ReportJSError( 'Failed validating payment info form', e );
	}

	try
	{
				if ( errorString != '' )
		{
			var rgErrors = errorString.split( '<br/>' );
			DisplayErrorMessage( errorString );
		}
		else
		{
			// submit the form
			$J.ajax( {
				url: baseURL + '/ajaxsaveuserpaymentinfo/',
				method: "POST",
				data: $J( "#WorkshopPaymentInfoForm" ).serialize(),
				success : function( response ) {
					var dialog = ShowAlertDialog( '저장 완료!', response.redirect_url.length != 0 ? '귀하의 연락처와 주소 정보가 저장되었습니다. 귀하의 국가 정보가 변경되었기 때문에, 세금 정보를 갱신하기 위한 외부 서비스로 이동합니다.' : '귀하의 연락처 및 주소 정보가 저장되었습니다. 만약 귀하가 이미 가지고 있지 않다면, 귀하의 은행 계좌 및 세금 정보를 기입해 주십시오.' );
					dialog.done( function() {
						if ( response.redirect_url.length != 0 )
						{
							top.location.assign( response.redirect_url );
						}
						else
						{
							top.location.reload();
						}
					} );
				},
				error: function( jqXHR ) {
					var json = jqXHR.responseJSON;
					if ( json.hasOwnProperty( "msg" ) )
					{
						ShowAlertDialog( '오류', json.msg );
					}
					else
					{
						ShowAlertDialog( '오류', '정보를 저장하는 도중 알 수 없는 오류가 발생했습니다.' );
					}
				}
			} );
		}
	}
	catch(e)
	{
		ReportJSError( 'Failed showing error or submitting payment info form', e );
	}
}

function validateFields()
{
		var errorString = '';

	bOk = true;

		try
	{
		if ( $('country').value == 'US' )
		{
			$('state').value = $('state_select').value;
		}
		else
		{
			$('state').value = $('state_input').value;
		}

		if ( $('bankcountry').value == 'US' )
		{
			$('bankstate').value = $('bankstate_select').value;
		}
		else
		{
			$('bankstate').value = $('bankstate_input').value;
		}
		
		if ( !IsIBANCountry( $('bankcountry').value ) )
		{
			$('bankiban').value = '';
		}

				if ( $( 'iscompany' ).checked )
		{
			if ( !IsValidRequiredField( "#firstname", gValidFieldAlphaNumericRegex ) )
			{
				errorString += '회사 이름을 적어주세요.<br/>';
			}
		 	$( 'lastname' ).value = '';
		}
		else
		{
			if ( !IsValidRequiredField( "#firstname", gValidFieldAlphaNumericRegex ) )
			{
				errorString += '성씨를 올바르게 입력해 주세요.<br/>';
			}
			if ( !IsValidRequiredField( "#lastname", gValidFieldAlphaNumericRegex ) )
			{
				errorString += '성씨를 제외한 이름을 올바르게 입력해 주세요.<br/>';
			}
		}
		if ( !IsValidEmailAddress( $( 'email' ).value ) )
		{
			errorString += '이메일 주소를 올바르게 입력해 주세요.<br/>';
		}

				if ( !IsValidRequiredField( "#address1", gValidFieldAlphaNumericRegex ) )
		{
			errorString += '주소를 올바르게 입력해 주세요.<br/>';
		}
		if ( !IsValidRequiredField( "#city", gValidFieldAlphaNumericRegex ) )
		{
			errorString += '도시 이름을 올바르게 입력해 주세요.<br/>';
		}

		if ( $('country').value == 'US' || $('country').value == 'UA' )
		{
			if ( $( 'zip' ).value.length < 1 )
			{
				errorString += '우편번호를 올바르게 입력해 주세요.<br/>';
			}
		}

		if ( $( 'phone' ).value.length < 1 )
		{
			errorString += '지역 번호를 포함한 휴대 전화 번호를 입력해주세요.<br/>';
		}

				if ( !IsValidRequiredField( "#bankname", gValidFieldAlphaNumericRegex ) )
		{
			errorString += '은행 이름을 올바르게 입력해 주세요.<br/>';
		}
		if ( !IsValidRequiredField( "#bankaccountholdername", gValidFieldAlphaNumericRegex ) )
		{
			errorString += '예금주 이름을 올바르게 입력해 주세요(은행 기록과 같아야 함).<br/>';
		}

				if ( !IsValidRequiredField( "#bankaddress1", gValidFieldAlphaNumericRegex ) )
		{
			errorString += '은행 주소를 올바르게 입력해 주세요.<br/>';
		}
		if ( !IsValidRequiredField( "#bankcity", gValidFieldAlphaNumericRegex ) )
		{
			errorString += '주거래 은행이 위치한 도시 이름을 올바르게 입력해 주세요.<br/>';
		}
		if ( $('bankcountry').value == 'US' || $('bankcountry').value == 'UA' )
		{
			if ( $( 'bankzip' ).value.length < 1 )
			{
				errorString += '주거래 은행의 우편번호를 올바르게 입력해 주세요.<br/>';
			}
		}

				if ( $( 'bankaccountnumber' ).value.length < 1 && !IsIBANCountry( $('bankcountry').value ) )
		{
			errorString += '계좌 번호를 입력해주세요.<br/>';
		}
		if ( $( 'bankcountry' ).value == 'US' )
		{
			$('bankiban').value = '';
			$('swiftcode').value = '';
			if ( $( 'bankaccountroutingnumber' ).value.length != 9 && $( 'bankaccountroutingnumber' ).value != $( 'storedroutingnumber' ).value)
			{
				errorString += '계좌의 고유 번호를 입력해주세요. (9자)<br/>';
			}
		}
		else if ( $( 'bankcountry' ).value == 'CA' )
		{
			$('bankiban').value = '';
			$('swiftcode').value = '';
			if ( $( 'bankaccountroutingnumber' ).value.length != 9 && $( 'bankaccountroutingnumber' ).value != $( 'storedroutingnumber' ).value)
			{
				errorString += '캐나다 운송장 번호를 입력해주십시오 (0으로 시작하는 9자리 숫자).<br/>';
			}
		}
		else if ( IsIBANCountry( $('bankcountry').value ) )
		{
			if ( $( 'bankiban' ).value.length < 1 )
			{
				errorString += '주거래 은행의 IBAN 코드를 입력해주세요.<br/>';
			}
			if ( $( 'swiftcode' ).value.length < 1 )
			{
				errorString += '귀하의 은행 SWIFT 코드를 넣어주세요.<br/>';
			}
		}
		else
		{
			$('bankiban').value = '';
			if ( $( 'swiftcode' ).value.length < 1 )
			{
				errorString += '귀하의 은행 SWIFT 코드를 넣어주세요.<br/>';
			}
		}
	}
	catch(e)
	{
		ReportJSError( 'Failed validating payment info form', e );
	}

	try
	{
				if ( errorString != '' )
		{
			var rgErrors = errorString.split( '<br/>' );
			DisplayErrorMessage( errorString );
		}
		else
		{
			// submit the form
			document.getElementById( 'WorkshopPaymentInfoForm' ).submit();
		}
	}
	catch(e)
	{
		ReportJSError( 'Failed showing error or submitting payment info form', e );
	}
}

function SharedFileBindMouseHover( elemId, loggedIn, itemData )
{
	var elem = $( elemId );
	Event.observe( elem, "mouseover", function() { SharedFileHover( elem, null, itemData['id'], loggedIn, itemData ); } );
	Event.observe( elem, "mouseout", function( event ) { HideWorkshopItemHover( elem, event ); } );
}

function SharedFileHover( elem, event, id, loggedIn, itemData )
{
	divHover = $('workshop_item_hover');
	if (!event) var event = window.event;
	elem = $(elem);

	var hover = $(divHover);
	if ( hover.visible() && hover.target == elem )
	{
		return;
	}
	else if ( ( !hover.visible() || hover.target != elem ) )
	{
		var description = itemData['description'] ? itemData['description'] : '';
		if ( description.length == 0 )
		{
			description = itemData['short_description'] ? itemData['short_description'] : '';
		}
		hover.down('.content').update( '<div class="hoverWorkshopItemTitle">' + itemData['title'] + '</div>' + '<div class="hoverWorkshopItemDesc">' + description + '</div>' );
		if ( itemData['user_subscribed'] )
		{
			$( 'hover_subscribed' ).show();
		}
		else
		{
			$( 'hover_subscribed' ).hide();
		}
		if ( itemData['user_favorited'] )
		{
			$( 'hover_favorited' ).show();
		}
		else
		{
			$( 'hover_favorited' ).hide();
		}
		if ( itemData['played'] )
		{
			$( 'hover_played' ).show();
		}
		else
		{
			$( 'hover_played' ).hide();
		}
		if ( itemData['user_subscribed'] || itemData['user_favorited'] || itemData['played'] )
		{
			$( 'hover_user_action_history' ).show();
		}
		else
		{
			$( 'hover_user_action_history' ).hide();
		}

		var hoverSubscriptions = $( 'hover_subscriptions' );

		// retrieve favorited by friends info
		var targetId = "favorited_by_friends_" + id;
		var elemData = $( targetId );
		ShowWorkshopItemHover( elem, divHover, loggedIn ? targetId : null );
		if ( loggedIn && !elemData && !elem.ajaxRequest )
		{
			var newDiv = new Element( 'div', { id: targetId } );
			hoverSubscriptions.down('.contentNoTopPadding').appendChild( newDiv );
			window.setTimeout( function() {
				if ( !elem.ajaxRequest ) {
					elem.ajaxRequest = new Ajax.Updater( newDiv,
								'https://steamcommunity.com/sharedfiles/friendswhofavoritedfile?id=' + id + '&appid=' + itemData['appid'],
								{ method: 'get', onComplete: function() { UpdateWorkshopItemHover( elem, divHover, targetId ); } } );
				}
			}, 0 );
		}
	}
}

function HideWorkshopItemHover( elem, event )
{
	divHover = $('workshop_item_hover');
	if (!event) var event = window.event;
	var reltarget = (event.relatedTarget) ? event.relatedTarget : event.toElement;
	if ( reltarget && $(reltarget).up( '#' + elem.identify() ) )
	{
		return;
	}
	divHover.hide();
}

function UpdateWorkshopItemHover( elem, divHover, targetContent )
{
	divHover = $('workshop_item_hover');
	if ( !divHover.visible() )
		return;
	ShowWorkshopItemHover( elem, divHover, targetContent );
}

function ShowWorkshopItemHover( elem, divHover, targetContent )
{
	var hover = $(divHover);
	hover.style.visibility = 'hidden';
	hover.show();

	if ( targetContent == null || $( targetContent ) == null )
	{
		$( 'hover_subscriptions' ).hide();
	}
	else
	{
		$( targetContent ).siblings().invoke('hide');
		$( targetContent ).show();
		if ( $( targetContent ).childElements().size() > 0 )
		{
			$( 'hover_subscriptions' ).show();
		}
		else
		{
			$( 'hover_subscriptions' ).hide();
		}
	}

	hover.clonePosition( elem, {setWidth: false, setHeight: false} );
	var hover_box = hover.down( '.hover_box' );
	var hover_arrow_left = hover.down( '.hover_arrow_left' );
	var hover_arrow_right = hover.down( '.hover_arrow_right' );

	var hover_arrow = hover_arrow_left;

	var nHoverHorizontalPadding = (hover_arrow ? -4 : 8);
	var boxRightViewport = elem.viewportOffset().left + parseInt( elem.getDimensions().width ) + hover_box.getWidth() + ( 24 - nHoverHorizontalPadding );
	var nSpaceRight = document.viewport.getWidth() - boxRightViewport;
	var nSpaceLeft = parseInt( hover.style.left ) - hover.getWidth();
	if ( boxRightViewport > document.viewport.getWidth() && nSpaceLeft > nSpaceRight)
	{
				hover.style.left = ( parseInt( hover.style.left ) - hover.getWidth() + nHoverHorizontalPadding ) + 'px';
		hover_arrow = hover_arrow_right;
	}
	else
	{
				hover.style.left = ( parseInt( hover.style.left ) + parseInt( elem.getDimensions().width ) - nHoverHorizontalPadding ) + 'px';
	}

	if ( hover_arrow )
	{
		hover_arrow_left.hide();
		hover_arrow_right.hide();
		hover_arrow.show();
	}

	var nTopAdjustment = 0;

			if ( elem.getDimensions().height < 98 )
		nTopAdjustment =  elem.getDimensions().height / 2 - 49;
	hover.style.top = ( ( parseInt( hover.style.top ) - 13 ) + nTopAdjustment ) + 'px';

	var boxTopViewport = elem.viewportOffset().top + nTopAdjustment;
	if ( boxTopViewport + hover_box.getHeight() + 8 > document.viewport.getHeight() )
	{
		var nViewportAdjustment = ( hover_box.getHeight() + 8 ) - ( document.viewport.getHeight() - boxTopViewport );
				nViewportAdjustment = Math.min( hover_box.getHeight() - 74, nViewportAdjustment );
		hover.style.top = ( parseInt( hover.style.top ) - nViewportAdjustment ) + 'px';

		if ( hover_arrow )
			hover_arrow.style.top = ( 48 + nViewportAdjustment ) + 'px';
	}
	else
	{
		if ( hover_arrow )
			hover_arrow.style.top = '';
	}

	hover.hide();
	hover.style.visibility = '';
	
	hover.show();
}

function ToggleModalMediaDetails()
{
	if ( $('ModalDetailsContainer').visible() )
	{
		$('ModalDetailsContainer').hide();
		$('ShowModalCommentsAndDetailsBtn').show();
		$('HideModalCommentsAndDetailsBtn').hide();
	}
	else
	{
		$('ModalDetailsContainer').show();
		$('ShowModalCommentsAndDetailsBtn').hide();
		$('HideModalCommentsAndDetailsBtn').show();
	}
}

function TogglePopupVisibility( popupId, buttonId )
{
	if ( $(popupId).visible() )
	{
		HideWithFade( $(popupId) );
		$(buttonId).removeClassName( 'toggled' );
	}
	else
	{
		ShowWithFade( $(popupId) );
		$(buttonId).addClassName( 'toggled' );
	}
}

function HideGreenlightCallout()
{
	$('Greenlight_Callout').hide();
	SetCookie('hideGreenlightCallout', 1, 365, '/');
}

function toggleAutoPlay()
{
	var button = $('workshop_autoplay');
	var value="false";

	if( button.hasClassName('toggled') )
	{
		value = "true";
		button.removeClassName('toggled');
	} else {
		value = "false";
		button.addClassName('toggled');
	}

	var exdate=new Date();
	exdate.setDate(exdate.getDate() + 365);
	var c_value=escape(value) + "; expires="+exdate.toUTCString();
	document.cookie="bGameHighlightAutoplayDisabled=" + c_value;
}

function ShowEnlargedImagePreview( imageURL )
{
	var enlargedImage = $( 'enlargedImage' );
	enlargedImage.src = "";
	enlargedImage.src = imageURL;
	showModal( 'previewImageEnlarged', false, true );
	Event.stop( event );
	return false;
}

var bRetrievedFriendsPicker = false;
var gFriendsPicker = null;
function ShowContributorDialog( publishedfileid )
{
	var waitDialog = ShowBlockingWaitDialog( '기여자 관리', '친구 목록을 불러오는 중' );

	$J.get( "https://steamcommunity.com/sharedfiles/contributorpicker/" + publishedfileid,
		{},
		function( data, textStatus, jqXHR ) {
			waitDialog.Dismiss();
			gFriendsPicker = ShowAlertDialog( '기여자 관리', '<div class="friendsPicker" id="friendsPicker">' + data + '</div>', '취소' );
		}
	);
}

function AddContributor( steamid, profileName, avatarLink )
{
	var options = {
		method: 'post',
		postBody: 'steamid=' + steamid + '&sessionid=' + g_sessionID + '&id=' + publishedfileid,
		onSuccess: (function(publishedfileid){
			return function(transport)
			{
				gFriendsPicker.Dismiss();

				var responseJSON = transport.responseJSON;
				switch ( responseJSON.success )
				{
					case 1:
						// Grey out modal or show spinner?
						location.reload();
						break;
					default:
						ShowAlertDialog( '오류', '지정한 프로필을 찾을 수 없습니다.' );
						break;
				}
			}
		}(publishedfileid))
	};
	new Ajax.Request(
		'https://steamcommunity.com/sharedfiles/addcontributor',
		options
	);

}

function RemoveContributor( steamid, profileName, avatarLink )
{
	var options = {
		method: 'post',
		postBody: 'steamid=' + steamid + '&sessionid=' + g_sessionID + '&id=' + publishedfileid,
		onSuccess: (function(publishedfileid){
			return function(transport)
			{
				var json = transport.responseText.evalJSON();

				// Grey out modal or show spinner?
				gFriendsPicker.Dismiss();
				location.reload();
			}
		}(publishedfileid))
	};
	new Ajax.Request(
		'https://steamcommunity.com/sharedfiles/removecontributor',
		options
	);

}

function AcceptSplit( publishedfileid )
{
	var options = {
		method: 'post',
		postBody: 'id=' + publishedfileid + '&sessionid=' + g_sessionID,
		onSuccess: (function(publishedfileid){
			return function(transport)
			{
				location.reload();
			}
		}(publishedfileid))
	};
	new Ajax.Request(
		'https://steamcommunity.com/sharedfiles/acceptsplit',
		options
	);

}

function FinalizeContributors( publishedfileid )
{
	if ( confirm( '기여자를 확정하시겠습니까? 이 단계 이후로는 기여자를 추가하거나 삭제할 수 없습니다.' ) != true )
	{
		return;
	}

	var options = {
		method: 'post',
		postBody: 'id=' + publishedfileid + '&sessionid=' + g_sessionID,
		onSuccess: (function(publishedfileid){
			return function(transport)
			{
				location.reload();
			}
		}(publishedfileid))
	};
	new Ajax.Request(
		'https://steamcommunity.com/sharedfiles/finalizecontributors',
		options
	);
}

function KVPrompt( title, description, key, value )
{
	$('PromptTitle').innerHTML = title ;
	$('PromptDescription').innerHTML = description ;
	$('PromptValue').value = value;
	$('PromptValue').name = key;
	showModal('PromptModal');
}

function HighlightSearchText( text, elem )
{
	if (!(elem instanceof Node) || elem.nodeType !== Node.ELEMENT_NODE)
		return;

	var children = elem.childNodes;

	for (var i=0; children[i]; ++i)
	{
		node = children[i];

		if (node.nodeType == Node.TEXT_NODE )
		{
			var strEscaped = $J('<div>').text(node.nodeValue).html();
			strReplace = strEscaped.replace( new RegExp('(' + text.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&")  + ')', 'gi' ), '<span class="searchedForText">$1</span>');
			eleReplace = document.createElement('div');
			eleReplace.innerHTML = strReplace;

			while( eleReplace.firstChild )
				node.parentNode.insertBefore( eleReplace.firstChild, node );

			node.parentNode.removeChild( node );
		}
		else if ( node.nodeType == Node.ELEMENT_NODE )
			HighlightSearchText(text, node);
	}
}

var gExternalTagSelectorWaitDialog = null;

function ShowExternalTagSelectorDialog_OnLoad()
{
	if ( gExternalTagSelectorWaitDialog )
	{
		gExternalTagSelectorWaitDialog.Dismiss();
		gExternalTagSelectorWaitDialog = null;
	}
	$( 'ExternalTagSelectorDialogIFrame' ).show();
}

function ShowExternalTagSelectorDialog( url, formID, submitFuncCB )
{
	if ( gExternalTagSelectorWaitDialog )
	{
		gExternalTagSelectorWaitDialog.Dismiss();
		gExternalTagSelectorWaitDialog = null;
	}
	gExternalTagSelectorWaitDialog = ShowBlockingWaitDialog( '잠시 기다려 주세요', '옵션 불러오는 중...' );

	$( 'ExternalTagSelectorDialogIFrame' ).hide();
	$( 'ExternalTagSelectorDialogIFrame' ).src = url;
	showModal( 'ExternalTagSelectorDialog' );

	ListenToIFrameMessage(
		function( event ) {
			var allowedHostName = 'https://' + getHostname( url );
			if ( event.origin !== allowedHostName )
				return;

			var msg = event.data.evalJSON();

			var msgType = msg['method'];

			switch( msgType )
			{
				case 'resize':
				{
					var height = msg['height'];
					var width = msg['width'];
					// show the iframe and size it
					$( 'ExternalTagSelectorDialogIFrame' ).show();
					$( 'ExternalTagSelectorDialogIFrame' ).effect = new Effect.Morph( 'ExternalTagSelectorDialogIFrame', { duration: 0.2, style: 'height: ' + height + 'px; width: ' + width + 'px' } );
					// center the dialog vertically and size it
					var flInverseZoom = 1 / (document.body.style.zoom || 1);
					var w = document.viewport.getWidth() * flInverseZoom;
					var h = document.viewport.getHeight() * flInverseZoom;
					var sl = document.viewport.getScrollOffsets().left;
					var st = document.viewport.getScrollOffsets().top;
					var cw = width;
					var ch = height;
					var newTop = (Math.floor((h / 2) - (height / 2)) + st);
					var newLeft = (Math.floor((w / 2) - (cw / 2)) + sl);
					$( 'ExternalTagSelectorDialog' ).effect = new Effect.Morph( 'ExternalTagSelectorDialog', { duration: 0.2, style: 'height: ' + height + 'px; width: ' + width + 'px; top: ' + newTop + 'px; left: ' + newLeft + 'px;' } );
				}
				break;

				case 'setfilter':
				{
					var tags = msg['tags'];

					var inputFields = $( formID ).getElementsByTagName('input');
					for ( var i = 0; i < inputFields.length; ++i )
					{
						var input = inputFields[i];
						if ( input.checked === true )
						{
							input.checked = false;
						}
					}

					for ( var i = 0; i < tags.length; ++i )
					{
						var elem = new Element( 'input', { 'name' : "requiredtags[]", 'value' : tags[i], 'checked' : 'true' } );
						$( formID ).appendChild( elem );
					}

					submitFuncCB();
				}
				break;
			} // switch
		}
	)
}

function IncludeTag( elem )
{
	if ( elem.checked )
	{
		var excludedTag = $J( '#excludetag_' + elem.id );
		excludedTag.removeClass( 'checked' );
	}

	FilterByTags();
}

function ExcludeTag( elem )
{
	elem = $J( elem );
	elem.toggleClass( 'checked' );

	var tagCheckbox = $J( "#" + elem.data( 'tagid' ) );
	if ( elem.hasClass( 'checked' ) )
	{
		tagCheckbox[0].checked = false;
	}

	FilterByTags();
}

/**
 * Service Provider Revenue Sharing
 */
var gServiceProviderRevenueSliders = Array();

function PickWorkshopServiceProviders( publishedFileID, appID )
{
	// pass through current values
	var splits = Array();
	for ( var i = 0; i < gServiceProviderRevenueSliders.length; ++i )
	{
		var slider = gServiceProviderRevenueSliders[i];
		splits.push( { 'steamid' : slider.GetSteamID(), 'split' : slider.GetValue() } );
	}

	$J.post( 'https://steamcommunity.com/sharedfiles/ajaxgetserviceproviders', {
			'id' : publishedFileID,
			'appid' : appID,
			'splits' : splits,
			'sessionid' : g_sessionID
		}
	).done( function( response ) {
		var strTitle = '서비스 제공자 선택하기';
		var strSaveChanges = '계속';
		var strDescription = response;
		var dialog = ShowConfirmDialog( strTitle, strDescription, strSaveChanges );

		dialog.SetRemoveContentOnDismissal( false );

		dialog.done( function() {
			// build list of service providers
			var service_providers = Array();
			var checkboxes = dialog.GetContent().find('input[type="checkbox"]');
			var existingValues = dialog.GetContent().find('input[type="hidden"]');
			for ( var i = 0; i < checkboxes.length; ++i )
			{
				var checkbox = checkboxes[i];
				if ( checkbox.checked )
				{
					service_providers.push( { 'steamid' : checkbox.value, 'split' : existingValues[i].value } );
				}
			}

			// get existing revenue splits, adding new and removing old
			$J.post( 'https://steamcommunity.com/sharedfiles/ajaxgetserviceprovidersplits', {
					'id' : publishedFileID,
					'sessionid' : g_sessionID,
					'service_providers' : service_providers,
					'override' : true
				}
			).done( function( response ) {
				gServiceProviderRevenueSliders = Array();
				$J('#ServiceProviders').replaceWith( response );
			});

			dialog.GetContent().remove();
		});

		dialog.fail( function() {
			dialog.GetContent().remove();
		});
	} );
}

var gNormalizingServiceProviderRevenueSliders = false;

function NormalizeServiceProviderRevenue( changingSlider )
{
	if ( gNormalizingServiceProviderRevenueSliders )
		return;

	gNormalizingServiceProviderRevenueSliders = true;
	var total = 0;
	for ( var i = 0; i < gServiceProviderRevenueSliders.length; ++i )
	{
		var slider = gServiceProviderRevenueSliders[i];
		total += slider.GetValue();
	}
	while ( total > 100 )
	{
		for ( var i = 0; i < gServiceProviderRevenueSliders.length && total > 100; ++i )
		{
			var slider = gServiceProviderRevenueSliders[i];
			if ( changingSlider != slider )
			{
				var value = slider.GetValue();
				if ( value > 0 )
				{
					slider.SetValue( value - 1 );
					total -= 1;
				}
			}
		}
	}
	gNormalizingServiceProviderRevenueSliders = false;
}

function SaveWorkshopServiceProviders( publishedFileID )
{
	var splits = Array();
	var total = 0;
	for ( var i = 0; i < gServiceProviderRevenueSliders.length; ++i )
	{
		var slider = gServiceProviderRevenueSliders[i];
		splits.push( { 'steamid' : slider.GetSteamID(), 'percentage' : slider.GetValue() } );
		total += slider.GetValue();
	}
	if ( total != 0 && total != 100 )
	{
		ShowAlertDialog( '오류', '서비스 제공자 수익율은 반드시 총합 100%가 되어야 합니다.' );
		return;
	}

	$J( "#SavingServiceProviderRevenueShares" ).show();
	$J( "#SavedServiceProviderRevenueShares" ).hide();

	$J.post( 'https://steamcommunity.com/sharedfiles/ajaxsetserviceprovidersplits', {
			'id' : publishedFileID,
			'splits' : splits,
			'sessionid' : g_sessionID
		}
	).done( function( response ) {
		$J( "#SavingServiceProviderRevenueShares" ).hide();
		$J( "#SavedServiceProviderRevenueShares" ).show();
	} ).fail( function( jqxhr ) {
		var rgResults = jqxhr.responseText.evalJSON();
		switch ( rgResults['success'] )
		{
			case 14:
				ShowAlertDialog( '오류', '귀하의 작품의 기여자로 등록된 제3사 단체를 선택하실 수 없습니다.' );
				break;
			default:
				ShowAlertDialog( '오류', '요청을 처리하는 동안 오류가 발생했습니다.' + ' ' + rgResults['success'] );
				break;
		}
		$J( "#SavingServiceProviderRevenueShares" ).hide();
	});
}

var ServiceProviderRevenueSlider = Class.create( {
	m_steamID: null,
	m_elemSlider: null,
	m_elemSliderBGFill: null,
	m_elemInput: null,
	m_elemDisplay: null,
	m_slider: null,

	initialize: function( args )
	{
		this.m_steamID = args.steamID;
		this.m_elemSlider = $( args.elemSlider );
		this.m_elemSliderBGFill = $( args.elemSliderBGFill );
		this.m_elemInput = $( args.elemInput );
		this.m_elemDisplay = $( args.elemDisplay );
		this.m_slider = new Control.Slider(
			this.m_elemSlider.down('.handle'),
			this.m_elemSlider,
			{
				range: $R( 0, 100 ),
				sliderValue: args.split,
				increment: 1,
				onSlide: this.SliderOnChange.bind( this ),
				onChange: this.SliderOnChange.bind( this )
			}
		);

		this.m_elemSliderBGFill.style.width = args.split + '%';

		gServiceProviderRevenueSliders.push( this );
	},

	SliderOnChange: function( value )
	{
		value = Math.ceil( value );
		this.m_elemInput.value = value;
		this.m_elemDisplay.innerHTML = value + '%';
		this.m_elemSliderBGFill.style.width = value + '%';
		NormalizeServiceProviderRevenue( this );
	},

	GetSteamID: function()
	{
		return this.m_steamID;
	},

	GetValue: function()
	{
		return parseInt( this.m_elemInput.value );
	},

	SetValue: function( value )
	{
		if ( value != this.GetValue() )
		{
			this.m_slider.setValue( value );
			this.m_elemInput.value = value;
			this.m_elemDisplay.innerHTML = value + '%';
			this.m_elemSliderBGFill.style.width = value + '%';
		}
	}
} );

