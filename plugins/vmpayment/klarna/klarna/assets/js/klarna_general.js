
var klarna_js_loaded = true;
if (typeof klarna == "undefined") {
var klarna = {
	invoice_fee: 0,
	sum : 0,
	gender : '',
	klarnaGeneralLoaded : true,
	selected_method : null,
	invoice_active : false,
	invoice_different_language : false,
	spec_active : false,
	spec_different_language : false,
	part_active : false,
	part_different_language : false,
	red_baloon_busy : false,
	blue_baloon_busy : false,
	address_busy : false,
	baloons_moved : false,
	flagChange_active : false,
	changeLanguage_busy : false,
	openBox_busy : false,
	showing_companyNotAlowed_box : false,
	gChoice : '',
    errorHandler: {
        show: function(parentBox, message, code, type) {
            var errorHTML = '<div class="klarna_errMsg"><span>'+message+'</span></div>';
            errorHTML += '<div class="klarna_errDetails">';
            if ( type != '' ) {
                errorHTML += '<span class="klarna_errType">'+type+'</span>';
            }
            if ( code != '' ) {
                errorHTML += '<span class="klarna_errCode">#'+code+'</span></div>';
            }

            if (jQuery('#klarna_red_baloon').length == 0) {
                klarna.errorHandler.create();
            }

            jQuery('#klarna_red_baloon_content').html(errorHTML);
            showRedBaloon(parentBox);
        },

        /**
         * Creates the red baloon used to show error messages
         */
        create: function() {
            jQuery(
                '<div class="klarna_red_baloon" id="klarna_red_baloon">' +
                '<div class="klarna_red_baloon_top"></div>' +
                '<div class="klarna_red_baloon_middle" id="klarna_red_baloon_content"></div>' +
                '<div class="klarna_red_baloon_bottom"></div>' +
                '</div>').appendTo('body');
        }
    },
	hidePaymentOption : function  (box, animate) {
		if (typeof animate == 'undefined') {
			animate = false;
		}

		if (animate) {
			jQuery(box).find('.klarna_box_top_right, .klarna_box_bottom').
				css({'display': 'none'});
		} else {
			jQuery(box).find('.klarna_box_top_right, .klarna_box_bottom').
			fadeOut('fast');
		}

		jQuery(box).animate({'min-height': '55px'}, 200);
		klarna.showHideIlt(jQuery(box).find('.klarna_box_ilt'), false, animate);
	},

	showPaymentOption : function  (box, animate, currentMinHeight, different_language) {
		if (typeof animate == 'undefined') {
			animate = false;
		}
		console.log('box',box);
		if (animate) {
			jQuery(box).animate({"min-height": currentMinHeight}, 200, function () {
				klarna.showHideIlt(jQuery(this).find('.klarna_box_ilt'), true);
				jQuery(this).find('.klarna_box_bottom').fadeIn('fast', function () {
					jQuery('.klarna_box_bottom_content_loader').fadeOut();

					if (klarna.showing_companyNotAlowed_box)
					{
						klarna.hideRedBaloon();
					}
				});
				jQuery(this).find('.klarna_box_top_right').fadeIn('fast');

				if (different_language) {
					jQuery(this).find('.klarna_box_bottom_languageInfo').fadeIn('fast');
					jQuery('.klarna_box_bottom_languageInfo').fadeIn('fast');
				}
				klarna.openBox_busy = false;
			});
		} else {
			jQuery(box).find('.klarna_box_top_right, .klarna_box_bottom').fadeIn('fast');
			klarna.showHideIlt(jQuery(box).find('.klarna_box_ilt'), true, animate);
		}
	},

	initPaymentSelection : function  (choice) {
		var isklarna = choice.hasClass('klarnaPayment');
		klarna.gChoice = '';
		if ( isklarna ) klarna.gChoice = choice.attr('id');
		//jQuery('input[value="'+choice+'"]').attr("id");
		var klarnaBox = jQuery('#paymentForm .klarnaPayment');
		klarnaBox.each(function () { 
			var boxid = jQuery(this).attr('id');
			if (klarna.gChoice != boxid)
			klarna.hidePaymentOption(boxid);
		});
		klarna.choosePaymentOption(klarna.gChoice);
	},

	choosePaymentOption : function  (choice) {
		if (klarna.openBox_busy == false)
		{
			klarna.hideRedBaloon();
			klarna.hideBlueBaloon();
			klarna.openBox_busy = true;
			jQuery('input[value="'+choice+'"]').attr("checked", "checked");
			jQuery('input[id="'+choice+'"]').attr("checked", "checked");
			// choice = klarna_invoice
			if (choice == klarna.invoice_name)
			{
				klarna.hidePaymentOption(jQuery('#klarna_box_part'), true);
				klarna.hidePaymentOption(jQuery('#klarna_box_spec'), true);
				klarna.showPaymentOption(jQuery('#klarna_box_invoice'), true,
				klarna.currentMinHeight_invoice, klarna.invoice_different_language);
				klarna.invoice_active = true;

			}
			else if (choice == klarna.part_name)
			{
				klarna.hidePaymentOption(jQuery('#klarna_box_invoice'), true);
				klarna.hidePaymentOption(jQuery('#klarna_box_spec'), true);
				klarna.showPaymentOption(jQuery('#klarna_box_part'), true,
				klarna.currentMinHeight_part, klarna.part_different_language);
				klarna.part_active = true;
			}
			else if (choice == klarna.spec_name)
			{
				klarna.hidePaymentOption(jQuery('#klarna_box_invoice'), true);
				klarna.hidePaymentOption(jQuery('#klarna_box_part'), true);
				klarna.showPaymentOption(jQuery('#klarna_box_spec'), true,
				klarna.currentMinHeight_spec, klarna.spec_different_language);
				klarna.spec_active = true;
			}
			else {
				klarna.hidePaymentOption(jQuery('#klarna_box_invoice'), true);
				klarna.hidePaymentOption(jQuery('#klarna_box_part'), true);
				klarna.hidePaymentOption(jQuery('#klarna_box_spec'), true);
				
				// jQuery('.klarna_box_bottom_languageInfo').fadeOut('fast');


					invoice_active = false;
					klarna.openBox_busy = false;
			}
		}
		klarna.selected_method = choice;
		console.log(choice);
	},

	setGender : function  (context, gender) {
		// This should be refactored to not be able to set other non-gender radio buttons
		var value;
		if (gender == 'm' || gender == '1')
		{
			jQuery('.Klarna_radio[value=1]', context).attr('checked', 'checked');
		}
		else if (gender == 'f' || gender == '0')
		{
			jQuery('.Klarna_radio[value=0]', context).attr('checked', 'checked');
		}
	},

	/**
	 * Hook up jQuery callbacks for the given klarna_box_container(s) or
	 * all klarna options in the document
	 */
	initPaymentOptions : function (opts) {
		if (typeof opts == 'undefined') {
			opts = jQuery(document);
		}
		// specialCampaign only
		if(typeof InitKlarnaSpecialPaymentElements != 'undefined')
			InitKlarnaSpecialPaymentElements('specialCampaignPopupLink', klarna.eid, klarna.countryCode);

		// P-Classes box actions
		jQuery('.klarna_box', opts).find('ol').find('li').mouseover(function (){
			jQuery(this).not('.klarna_box_click').addClass('klarna_box_over');
		}).mouseout(function (){
			jQuery(this).not('.klarna_box_click').removeClass('klarna_box_over')

		}).click(function (){
			// Reset list and move chosen icon to newly selected pclass
			chosen = jQuery(this).parent("ol").find('img')
			klarna.resetListBox(jQuery(this).parent("ol"));
			chosen.appendTo(jQuery(this).find('div'));
			jQuery(this).attr("class", "klarna_box_click");

			// Update input field with pclass id
			var value = jQuery(this).find('span').html();
			var name = jQuery(this).parent("ol").attr("id");

			jQuery(this).closest('.klarna_box').find("input.paymentPlan").attr("value", value);
		});

		if (klarna.countryCode == "de" || klarna.countryCode == "nl")
		{
			klarna.setGender(opts, klarna.gender);
		}

		// Input field on focus
		jQuery('.klarna_box', opts).find('input').focusin(function () {
			klarna.setBaloonInPosition(jQuery(this), false);
		}).focusout(function () {
			klarna.hideBaloon();
		});

		// Chosing the active language
		jQuery('.box_active_language', opts).click(function () {
			if (klarna.flagChange_active == false)
			{
				klarna.flagChange_active = true;

				jQuery(this).parent().find('.klarna_box_top_flag_list').slideToggle('fast', function () {
					if (jQuery(this).is(':visible'))
					{
						jQuery(this).parent('.klarna_box_top_flag').animate({opacity: 1.0}, 'fast');
					}
					else {
						jQuery(this).parent('.klarna_box_top_flag').animate({opacity: 0.4}, 'fast');
					}

					klarna.flagChange_active = false;
				});
			}
		});

		jQuery('.klarna_box_top_flag_list img', opts).click(function (){
			if (klarna.changeLanguage_busy == false)
			{
				klarna.changeLanguage_busy = true;

				var newIso = jQuery(this).attr("alt");

				jQuery('#box_active_language', opts).attr("src", jQuery(this).attr("src"));

				var box = jQuery(this).parents('.klarna_box_container');
				var params;
				var values;
				
				var boxType = box.find('.klarna_box').attr("id");
				var Type = boxType.substring( 11 );//'klarna_box_' 
				if (!Type) {
					console.log(boxType);
					return ;
				}
				klarna.changeLanguage(box, klarna['params_'+Type], newIso, klarna.countryCode, Type);
			}
		});

		setTimeout('klarna.prepareRedBaloon()', 1000);

		jQuery('.klarna_box_bottom_languageInfo', opts).mousemove(function (e) {
			klarna.showBlueBaloon(e.pageX, e.pageY, jQuery(this).find('img').attr("alt"));
		});

		jQuery('.klarna_box_bottom_languageInfo', opts).mouseout(function () {
			klarna.hideBlueBaloon();
		});

		jQuery('input.Klarna_radio', opts).bind('change', function () {
			klarna.gender = jQuery(this).val();
		});

		jQuery('.Klarna_pnoInputField', opts).each(function (){
			var pnoField = jQuery(this);

			jQuery(this).bind("keyup change blur focus", function (){
				klarna.pnoUpdated(jQuery(this),
					(jQuery(this).parents('.klarna_box').attr("id") == "klarna_box_invoice"));
			});
		});
	},

	doDocumentIsReady : function  ()
	{
		klarna.currentMinHeight_invoice = jQuery('#klarna_box_invoice').height();
		klarna.currentMinHeight_part = jQuery('#klarna_box_part').height();
		klarna.currentMinHeight_spec = jQuery('#klarna_box_spec').height();



		klarna.initPaymentOptions();
	},

	pnoUpdated : function  (box, companyAllowed) {
		var pno_value = jQuery.trim(jQuery(box).val());

		// Set the PNO to the other fields
		jQuery('.Klarna_pnoInputField').val(pno_value);

		// Do check
		if (pno_value != "") {
			jQuery('.klarna_box_bottom_content_loader').is(":hidden").fadeIn('fast');


			if (!validateSocialSecurity(pno_value)) {
				jQuery('.klarna_box_bottom_content_loader').fadeOut('fast');
				jQuery('.klarna_box_bottom_address').is(":visible").slideUp('fast');
			} else {
				klarna.getAddress (jQuery(box).closest('.klarna_box'), pno_value, companyAllowed);
			}
		} else {
			jQuery('.referenceDiv').is(":visible").slideUp('fast');
			// jQuery('.referenceDiv').is(":hidden").css({"display":"none"}); //Ilogic !
			jQuery('.klarna_box_bottom_content_loader').fadeOut('fast');

			jQuery('.klarna_box_bottom_address').is(":visible").slideUp('fast');
			//jQuery('.klarna_box_bottom_address').is(":hidden").css({"display":"none"}); // Ilogic !

		}
	},

	/**
	 * Showing and hiding the ILT questions
	 *
	 * @param field
	 * @param show
	 * @param animate
	 */
	showHideIlt : function  (field, show, animate)
	{
		if (show == false)
		{
			if (animate == true)
				field.slideUp('fast');
			else
				field.hide();
		}
		else {
			var length = field.find('.klarna_box_iltContents').find('.klarna_box_ilt_question').length;

			if (length > 0)
			{
				if (animate == true)
					field.slideDown('fast');
				else
					field.show();
			}

		}
	},

	prepareRedBaloon: function  ()
	{
		if (klarna.red_baloon_content != '') {
			if ( typeof code == 'undefined' ) {
				code = '';
			}
			klarna.errorHandler.show(jQuery('#'+klarna.red_baloon_box), klarna.red_baloon_content, code, '');
		}
	},

	getAddress : function  (parentBox, pno_value, companyAllowed)
	{
		if (!klarna.address_busy)
		{
			klarna.address_busy = true;

			data = {
				action: 'getAddress',
				country: klarna.countryCode,
				pno: pno_value
			}

			// Get the new klarna_box
			jQuery.ajax({
				type: "GET",
				url: ajax_path,
				data: data,
				success: function(xml){
					jQuery(xml).find('error').each(function() {
						var msg = jQuery(this).find('message').text();
						var code = jQuery(this).find('code').text();
						var type = jQuery(this).find('type').text();
						jQuery('.klarna_box_bottom_content_loader').fadeOut('fast', function () {
							klarna.address_busy = false;
						});
						klarna.errorHandler.show(parentBox, msg, code, type);
					});

					jQuery(xml).find('getAddress').each(function() {
						addresses = AddressCollection.fromXML(this);

						if (typeof klarna.params_invoice != "undefined")
							addresses.render('#klarna_box_invoice', klarna.params_invoice['shipmentAddressInput']);

						if (typeof klarna.params_part != "undefined")
							addresses.render('#klarna_box_part', klarna.params_part['shipmentAddressInput']);

						if (typeof klarna.params_spec != "undefined")
							addresses.render('#klarna_box_spec', klarna.params_spec['shipmentAddressInput']);

						jQuery.each(addresses.addresses, function(i, addr) {
							if (addr.isCompany) {
								jQuery('#invoiceType').val("company");
								jQuery('.referenceDiv').slideDown('fast');

								if (addresses.mode == Address.Single)
								{
									jQuery('.klarna_box_bottom').animate({"min-height": "300px"},'fast');
								}

								if (companyAllowed == false && typeof lang_companyNotAllowed != "undefined")
								{
									showRedBaloon(jQuery(box));
									jQuery('#klarna_red_baloon_content div').html(lang_companyNotAllowed);
									klarna.showing_companyNotAlowed_box = true;
								}
								else {
									klarna.hideRedBaloon();
								}
							} else {
								jQuery('#invoiceType').val("private");
								jQuery('.referenceDiv').slideUp('fast');

								jQuery('.klarna_box_bottom').animate({"min-height": "250px"},'fast');

								if (klarna.showing_companyNotAlowed_box)
									klarna.hideRedBaloon();
							}
						});

						jQuery('.klarna_box_bottom_address').slideDown('fast');
						jQuery('.klarna_box_bottom_content_loader').fadeOut('fast', function () {
							klarna.address_busy = false;
							klarna.hideRedBaloon();
						});
					});
					klarna.address_busy = false;
				}
			});
		}
	},

	showBlueBaloon : function  (x, y, text)
	{
		jQuery('#klarna_blue_baloon_content div').html(text);

		var top = (y - jQuery('#klarna_blue_baloon').height())-5;

		var left = (x - (jQuery('#klarna_blue_baloon').width()/2)+5);

		jQuery('#klarna_blue_baloon').css({"left": left, "top": top});

		jQuery('#klarna_blue_baloon').show();
	},

	hideBlueBaloon : function  ()
	{
		jQuery('#klarna_blue_baloon').hide();
	},

	showRedBaloon : function  (box) {
		if (klarna.red_baloon_busy)
			return;

		klarna.red_baloon_busy = true;
		var field;
		if (typeof box == 'undefined') {
			if (klarna.gChoice == "klarna_invoice") {
				box = jQuery('#klarna_box_invoice');
			} else if (klarna.gChoice == "klarna_partPayment") {
				box = jQuery('#klarna_box_part');
			} else if (klarna.gChoice == "klarna_SpecCamp") {
				box = jQuery('#klarna_box_spec');
			}
		}

		if (typeof box != 'undefined') {
			field = box.find('.klarna_logo');
		}

		if (typeof field == 'undefined' || field.length == 0) {
			field = jQuery('.klarna_logo:visible');
		}

		var position = field.offset();
		var top = (position.top - jQuery('#klarna_red_baloon').height()) + (jQuery('#klarna_red_baloon').height() / 6);
		if (top < 0) top = 10;
		position.top = top;

		var left = (position.left + field.width()) - (jQuery('#klarna_red_baloon').width() / 2);

		position.left = left;

		jQuery('#klarna_red_baloon').css(position);

		jQuery('#klarna_red_baloon').fadeIn('slow', function () {
			klarna.red_baloon_busy = false;

			setTimeout('klarna.fadeRedBaloon()', 3000);
		});
	},

	fadeRedBaloon : function  ()
	{
		if (klarna.red_baloon_busy)
			return;

		jQuery('#klarna_red_baloon').addClass('klarna_fading_baloon');
	},

	hideRedBaloon : function  ()
	{
		if (klarna.red_baloon_busy)
			return;

		if (jQuery('#klarna_red_baloon').is(':visible') && !klarna.red_baloon_busy)
		{
			jQuery('#klarna_red_baloon').fadeOut('fast', function () {
				klarna.red_baloon_busy = false;
				klarna.showing_companyNotAlowed_box = false;
			});
		}
	},

	/**
	 * This function is only available for swedish social security numbers
	 */
	validateSocialSecurity : function  (vPNO)
	{
		if (typeof vPNO == 'undefined')
			return false;

		return vPNO.match(/^([1-9]{2})?[0-9]{6}[-\+]?[0-9]{4}$/)
	},

	resetListBox : function  (listBox)
	{
		listBox.find('li').each(function (){
			if (jQuery(this).attr("id") == "click")
			{
				jQuery(this).attr("id", "");
			}

			jQuery(this).find('div img').remove();
		});
	},

	hideBaloon : function  (callback)
	{
		if (jQuery('#klarna_baloon').is(":visible"))
		{
			jQuery('#klarna_baloon').fadeOut('fast', function (){
				if( callback ) callback();

				return true;
			});
		}
		else {
			if( callback ) callback();
			return true;
		}
	},

	setBaloonInPosition : function  (field, red_baloon)
	{
		klarna.hideBaloon(function (){
			var position = field.offset();
			var name = field.attr('name');
			var value = field.attr('alt');

			if (!value && !red_baloon)
			{
				return false;
			}

			if (!red_baloon)
			{
				jQuery('#klarna_baloon_content div').html(value);

				var top = position.top - jQuery('#klarna_baloon').height();
				if (top < 0) top = 10;
				position.top = top;

				var left = (position.left + field.width()) - (jQuery('#klarna_baloon').width() - 50);

				position.left = left;

				jQuery('#klarna_baloon').css(position);

				jQuery('#klarna_baloon').fadeIn('fast');
			}
			else {
				var top = position.top - jQuery('#klarna_red_baloon').height();
				if (top < 0) top = 10;
				position.top = top;

				var left = (position.left + field.width()) - (jQuery('#klarna_red_baloon').width() - 50);

				position.left = left;

				jQuery('#klarna_red_baloon').css(position);

				jQuery('#klarna_red_baloon').fadeIn('fast');
			}
		});
	},

	saveDates : function (replaceBox, Type) {
		if (Type = 'invoice') Type='';
		else Type = Type+'_';
		klarna['select_'+Type+'bday']= jQuery(replaceBox).find('#selectBox_'+Type+'bday').val();
		klarna['select_'+Type+'bmonth'] = jQuery(replaceBox).find('#selectBox_'+Type+'bmonth').val();
		klarna['select_'+Type+'year'] = jQuery(replaceBox).find('#selectBox_'+Type+'year').val();
	},

	changeLanguage : function (replaceBox, params, newIso, country, Type)
	{
		var paramString    = "";
		var valueString = "";

		data = {
			action: 'languagepack',
			subAction: 'klarna_box',
			type: Type,
			newIso: newIso,
			country: country,
			sum: klarna.sum,
			fee: klarna.invoice_fee,
			flag: klarna.flag
		}

		// include current field values in request so that the values can be used
		// in the translation
		for (var attr in params) {
			data['params[' + attr + ']'] = params[attr];
			var inputValue = jQuery(replaceBox).find('input[name=' + params[attr] + ']').val();
			if (typeof inputValue != "undefined") {
				data['values[' + attr + ']'] = inputValue;
			}
		}
		virtuemart_paymentmethod_id = jQuery(replaceBox).parents('table').find('.klarnaPayment').val();
		data['cid'] = virtuemart_paymentmethod_id;
		klarna.saveDates(replaceBox, Type);
		jQuery.ajax({
			type: "GET",
			url: klarna.ajaxPath,
			data: data,
			success: function(response){
				//console.log(response);
				if (jQuery(response).find('.klarna_box'))
				{
					replaceBox.find('.klarna_box').remove();
					replaceBox.append(jQuery(response).find('.klarna_box'));
					if(newIso != klarna['language'])
						replaceBox.find('.klarna_box_bottom_languageInfo').fadeIn('slow', function () {
							klarna.changeLanguage_busy = false;
						});
					else
						replaceBox.find('.klarna_box_bottom_languageInfo').fadeOut('slow', function () {
							klarna.changeLanguage_busy = false;
						});

					klarna.methodReady(Type);
					klarna.initPaymentOptions(replaceBox);
				} else {
					alert("Error, block not found. Response:\n\n"+response);
				}
			}
		});
	},

	methodReady : function  (Type)
	{
		var foundBox = false;
		var currentMinHeight = jQuery('#klarna_box_invoice').height();
		if (Type == 'invoice') var name='';
		else var name = Type+'_' ;
		// Select birthdate and fill years box
		// console.log(Type, klarna.countryCode);
		if (klarna.countryCode == "de" || klarna.countryCode == "nl")
		{
			// Years box
			var date = new Date();
			for (i = date.getFullYear(); i >= 1900; i--)
			{
				jQuery('<option/>').val(i).text(i).appendTo('#selectBox_'+name+'year')
			}

			if(typeof klarna.select_bday != "undefined") {
				jQuery('#selectBox_'+name+'bday').val(klarna['select_'+name+'bday']);
			}

			if(typeof klarna.select_bmonth != "undefined") {
				jQuery('#selectBox_'+name+'bmonth').val(klarna['select_'+name+'bmonth']);
			}

			if(typeof klarna.select_byear != "undefined") {
				jQuery('#selectBox_'+name+'year').val(klarna['select_'+name+'byear']);
			}
		}

		// Chosing the active language
		jQuery('#box_active_language').click(function () {
			jQuery('.klarna_box_top_flag_list').slideToggle('fast', function () {
				if (jQuery(this).is(':visible'))
				{
					jQuery('.klarna_box_top_flag').animate({opacity: 1.0}, 'fast');
				}
				else {
					jQuery('.klarna_box_top_flag').animate({opacity: 0.4}, 'fast');
				}
			});
		});

		if (Type == 'invoice') {
			if(typeof invoice_ITId != "undefined") {
				jQuery('input[name='+invoice_ITId+']').change(function (){
					var val = jQuery(this).val();

					if (val == "private")
					{
						jQuery('#invoice_perOrg_title').text(lang_personNum);
						jQuery('#invoice_box_private').slideDown('fast');
						jQuery('#invoice_box_company').slideUp('fast');
					}
					else if (val == "company")
					{
						jQuery('#invoice_perOrg_title').text(lang_orgNum);
						jQuery('#invoice_box_company').slideDown('fast');
						jQuery('#invoice_box_private').slideUp('fast');
					}
				});
			}
		}
	}
}};
Address = function (companyName, firstName, lastName, street, zip, city, countryCode) {
    this.companyName = companyName;
    this.firstName = firstName;
    this.lastName = lastName;
    this.street = street;
    this.zip = zip;
    this.city = city;
    this.countryCode = countryCode;
    this.isCompany = (this.companyName.length > 0);
};

Address.fromXML = function (elem) {
    return new Address(
        jQuery(elem).find('companyName').text(),
        jQuery(elem).find('first_name').text(),
        jQuery(elem).find('last_name').text(),
        jQuery(elem).find('street').text(),
        jQuery(elem).find('zip').text(),
        jQuery(elem).find('city').text(),
        jQuery(elem).find('countryCode').text()
    );
};

Address.Mode = function Mode() {}
Address.Single = new Address.Mode();
Address.Multi = new Address.Mode();

Address.prototype.inputValue = function () {
    return [(this.isCompany
                ? this.companyName
                : (this.firstName + '|' + this.lastName)),
        this.street,
        this.zip,
        this.city,
        this.countryCode].join('|');
}

Address.prototype.render = function (mode) {
    if (mode == Address.Single) {
        return '<p>' +
            (this.isCompany
                ? this.companyName
                : (this.firstName + ' ' + this.lastName)) + '</p>' +
            '<p>' + this.street + '</p>' +
            '<p>' + this.zip + ' ' + this.city + '</p>' +
            '<p>' + this.countryCode + '</p>';
    } else if (mode == Address.Multi) {
        return '<option value="' + this.inputValue() + '">' +
            (this.isCompany
                ? this.companyName
                : (this.firstName + ' ' + this.lastName)) +
            ', ' + this.street +
            ', ' + this.zip + ' ' + this.city +
            ', ' + this.countryCode;
    }
}

AddressCollection = function (addresses) {
    this.addresses = addresses;
    this.mode = addresses.length > 1 ? Address.Multi : Address.Single;
}

AddressCollection.fromXML = function (elem) {
    var multi = (jQuery('address', elem).length > 1);

    return new AddressCollection(jQuery('address', elem).map(function () {
        var addr = Address.fromXML(this);
        return addr;
    }));
}

AddressCollection.prototype.render = function (to, inputName) {
    var box = jQuery(to).find('.klarna_box_bottom_address_content');
    box.empty();
    if (this.mode == Address.Single) {
        var inputValue = this.addresses[0].inputValue();
        var input = jQuery('<input type="hidden" name="' + inputName + '" value="' + inputValue + '" />')
        box.append(input);
        box.append(this.addresses[0].render(Address.Single));
    } else if (this.mode == Address.Multi) {
        var select = jQuery('<select name="' + inputName + '">')
        box.append(select);

        jQuery.each(this.addresses, function(i, addr) {
            select.append(addr.render(Address.Multi));
        });
    }
}

	//Load when document finished loading
	jQuery(document).ready(function ($){
		var baloon = $('.klarna_baloon').clone();
		$('.klarna_baloon').remove();

		var baloon3 = $('.klarna_blue_baloon').clone();
		$('.klarna_blue_baloon').remove();


		$('body').append(baloon);
		$('body').append(baloon3);

		klarna.doDocumentIsReady();

		$('.klarna_box_bottom_languageInfo').remove();

		if (!klarna.unary_checkout) {
			var pList = jQuery('#paymentForm input[type=radio][name=virtuemart_paymentmethod_id]');
			klarna.initPaymentSelection(pList.filter(":checked"));
			pList.click( function (){
				klarna.initPaymentSelection( jQuery(this) );
			});
		}
		$('.klarnaPayment').parents('form').submit( function(){
			var vmmethod = $(this).find('input:radio[name=virtuemart_paymentmethod_id]:checked');

			if (!vmmethod.hasClass('klarnaPayment')) return ;

			var action = vmmethod.parents('form').attr('action');

			//$.post(action,fields);
			var selectedTable= vmmethod.parents('table');
			var fields = selectedTable.find('*').serializeArray();
			fields.push({"name":"task","value":"setpayment"});
			fields.push({"name":"view","value":"cart"});
			fields.push({"name":"klarna_paymentmethod","value":klarna.selected_method});
			var form = $('<form></form>');
			form.attr("method", "post");
			form.attr("action", action);
			//fields
			$.each(fields, function(key, value) {
				var field = $('<input></input>');
				
				field.attr("type", "hidden");
				field.attr("name", value["name"]);
				field.attr("value", value["value"]);

				form.append(field);
			});

			// The form needs to be apart of the document in
			// order for us to be able to submit it.
			$(document.body).append(form);
			form.submit();

			console.log(fields);
			return false;
		});
		klarna.baloons_moved = true;
	});
