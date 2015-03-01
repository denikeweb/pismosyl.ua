SmartCore = {
	main : function () {
		SmartCore.libs.gallery.init ();
		SmartCore.libs.scrollBar.init ();

		SmartCore.navigation.menuAnimation ();

		$('.ctgr').on ('click', SmartCore.constructor.templates.catClick);
		$('.ctgrList').on ('click', SmartCore.constructor.templates.openCatList);
		$('.preview-box').on ('click', SmartCore.constructor.templates.showText);

		SmartCore.constructor.templates.init ();
		SmartCore.constructor.switcher.init ();
		$('.constructorVisitor').on ('change', SmartCore.constructor.validator.visitor);

		$('.myTextWrite').on ('click', SmartCore.constructor.templates.myTextWrite);
        $('.surgutchImg').on ('click',SmartCore.constructor.templates.surgutchImgCheck);
        $('.initials').on ('click',SmartCore.constructor.templates.surgutchInputCheck);
	},
	globals : {
		lastOpenedSubCat : undefined,
		thisTemplateId : 0,
		thisTextContainerObj : undefined,
		personalText : false
	},
	libs : {
		scrollBar : {
			init : function () {
				$('.scrollbar-inner').scrollbar();
			}
		},
		gallery : {
			init : function () {
				$('.photoSetPic').colorbox({rel:'.photoSetPic'});
				$('.pictureSB').colorbox({rel:'.pictureSB'});
				$('.pictureC').colorbox({rel:'.pictureC'});
                $('.surgutchGal').colorbox({rel:'.surgutchGal'});
			}
		}
	},
	constructor : {
		templates : {
			init : function () {
				$('.letters.categories').children ().first().click ();
			},
			catClick : function () {
				var $this = $(this),
					dataId = $this.attr ('data-id'),
					thisCatGroup = $('.catGroup.id' + dataId);
				$('.ctgr').removeClass('active');
				$this.addClass('active');
				$('.catGroup').addClass('hidden');
				thisCatGroup.removeClass('hidden');
				SmartCore.constructor.templates.showText(thisCatGroup);
			},
			openCatList : function () {
				var $this = $(this),
					thisCat = $this.next ('.subcategories'),
					isReturn = false;
				if ($this.hasClass('opened')) isReturn = true;
				if (SmartCore.globals.lastOpenedSubCat != undefined) {
					SmartCore.globals.lastOpenedSubCat.prev ('.ctgrList').removeClass('opened').addClass('closed');
					SmartCore.globals.lastOpenedSubCat.hide();
				}
				if (isReturn) return;
				SmartCore.globals.lastOpenedSubCat = thisCat;
				$this.removeClass('closed').addClass('opened');
				SmartCore.globals.lastOpenedSubCat.show ();
			},
			showText : function (thisObj) {
				var $thisCldrn = $(this).children ();
				if (thisObj.length != undefined)
					$thisCldrn = SmartCore.constructor.templates.getPrevObjForFirstCat(thisObj);
				var id = $thisCldrn.filter('.preview-id').html (),
					textContainerObj = $thisCldrn.filter('.preview-text'),
					text = (textContainerObj.html () === undefined) ? '' : textContainerObj.html ();
				if (text.length > 0)
					SmartCore.constructor.templates.viewText(id, text, textContainerObj);
				else
					SmartCore.constructor.templates.getText(id, textContainerObj);
			},
			getPrevObjForFirstCat : function (thisObj) {
				return thisObj.children ().first ().children ();
			},
			getText: function (id, textContainerObj) {
				var sendData = 'action=GetText&id=' + id,
					successFunc = function (text) {
						SmartCore.constructor.templates.saveText(textContainerObj, text);
						SmartCore.constructor.templates.viewText(id, text, textContainerObj);
					};
				$.ajax({
					url: '//' + document.domain + '/ajax',
					type: 'GET',
					timeout: 5000,
					data: sendData,
					success : successFunc
				});
				return true;
			},
			saveText : function (textContainerObj, data) {
				textContainerObj.html (data);
			},
			viewText : function (id, text, textContainerObj, own) {
				if (textContainerObj !== undefined && text.length < 1) return true;

				var active = 'active',
					$content = $('.text-letter-content'),
					$thisContentText = $content.html ();
				if (SmartCore.globals.thisTextContainerObj != undefined)
					SmartCore.globals.thisTextContainerObj.html ($thisContentText);
				$content.html (text);
				$('.preview-box.active').removeClass(active);
				if (textContainerObj !== undefined)
					textContainerObj.parent().addClass (active);
				SmartCore.globals.thisTemplateId = id;
				SmartCore.globals.thisTextContainerObj =
					(own == undefined) ? textContainerObj : $('.myTextField').first ();

				$('.templateTextArea').on ('keyup', SmartCore.constructor.templates.onKeyUp.textarea);
				$('.templateInput').on ('keyup', SmartCore.constructor.templates.onKeyUp.input);
			},
			onKeyUp : {
				textarea : function () {
					$this = $(this);
					$this.html ( $this.val () );
				},
				input : function () {
					$this = $(this);
					$this.attr ( 'value', $this.val () );
				}
			},
			myTextWrite : function () {
				var text = $('.myTextField').html ();
				SmartCore.constructor.templates.viewText('-1', text, undefined, true);
			},
            surgutchImgCheck : function () {
                var $this = $(this);
                var $radioButton = $this.parent().parent().children('.surgutchRb');
                $radioButton.click();
            },
            surgutchInputCheck : function () {
                var $this = $(this);
                var $radioButton = $this.parent().children('.surgutchRb');
                $radioButton.click();
            }
		},
		switcher : {
			vars : {
				nav1 : undefined,
				nav2 : undefined,
				nav3 : undefined,

				previous : undefined,
				next : undefined,
				toPay : undefined,

				step1 : undefined,
				step2 : undefined,
				step3 : undefined,

				thisStep : 1
			},
			classes : {
				active : 'active',
				stepped : 'stepped',
				hidden : 'hidden'
			},
			init : function () {
				this.vars.nav1     =  $('.constructor-navigator.step1');
				this.vars.nav2     =  $('.constructor-navigator.step2');
				this.vars.nav3     =  $('.constructor-navigator.step3');
				this.vars.previous  =  $('.constructor-switcher.previous');
				this.vars.next      =  $('.constructor-switcher.next');
				this.vars.toPay     =  $('.constructor-switcher.toPay');

				this.vars.step1     =  $('.constructor-steps.step1');
				this.vars.step2     =  $('.constructor-steps.step2');
				this.vars.step3     =  $('.constructor-steps.step3');

				this.vars.previous.on ( 'click', this.previousHandler );
				this.vars.next.on     ( 'click', this.nextHandler     );
				this.vars.toPay.on    ( 'click', this.toPayHandler    );
			},
			previousHandler : function () {
				var a = SmartCore.constructor.switcher,
					b = a.vars;
				if (b.thisStep == 2)
					a.showStep1 ();
				else
					a.showStep2 ();
			},
			nextHandler : function () {
				var a = SmartCore.constructor.switcher,
					b = a.vars;
				if (b.thisStep == 1)
					a.showStep2 ();
				else
					a.showStep3 ();
			},
			toPayHandler : function () {
				SmartCore.services.InterKassa.redirect(
					SmartCore.services.InterKassa.dataStab.services,
					SmartCore.services.InterKassa.dataStab.letter,
					SmartCore.services.InterKassa.dataStab.customerContacts
				);
			},
			showStep1 : function () {
				var a = SmartCore.constructor.switcher,
					b = a.vars,
					c = a.classes;
				b.nav1.addClass(c.active);
				b.nav1.removeClass(c.stepped);

				b.nav2.removeClass(c.active);

				b.previous.addClass(c.hidden);
				b.next.removeClass(c.hidden);

				b.thisStep = 1;
				b.step1.removeClass(c.hidden);
				b.step2.addClass(c.hidden);
			},
			showStep2 : function () {
				var a = SmartCore.constructor.switcher,
					b = a.vars,
					c = a.classes;
				b.nav2.addClass(c.active);
				b.nav2.removeClass(c.stepped);

				b.nav1.removeClass(c.active);
				b.nav1.addClass(c.stepped);
				b.nav3.removeClass(c.active);

				b.previous.removeClass(c.hidden);
				b.next.removeClass(c.hidden);
				b.toPay.addClass(c.hidden);

				b.thisStep = 2;
				b.step1.addClass(c.hidden);
				b.step2.removeClass(c.hidden);
				b.step3.addClass(c.hidden);
			},
			showStep3 : function () {
				var a = SmartCore.constructor.switcher,
					b = a.vars,
					c = a.classes;
				b.nav3.addClass(c.active);
				b.nav3.removeClass(c.stepped);

				b.nav2.removeClass(c.active);
				b.nav2.addClass(c.stepped);
				b.nav3.addClass(c.active);

				b.previous.removeClass(c.hidden);
				b.next.addClass(c.hidden);
				b.toPay.removeClass(c.hidden);

				b.thisStep = 3;
				b.step2.addClass(c.hidden);
				b.step3.removeClass(c.hidden);
			}
		},
		validator : {
			valid_all : function ($services, $letter) {
				var jsonDataArray = {
						services: $services,
						letter: $letter
					},
				jsonData = JSON.stringify (jsonDataArray),
				sendData = 'action=Validator&jsonData=' + jsonData,
					successFunc = function (text) {
						// TODO: sth action
					};
				$.ajax ({
					url: '//' + document.domain + '/ajax',
					type: 'GET',
					timeout: 5000,
					data: sendData,
					success : successFunc
				});
			},
			get_price : function ($services, $letter) {
				var jsonDataArray = {
						services: $services,
						letter: $letter
					},
					jsonData = JSON.stringify (jsonDataArray),
					sendData = 'action=GetPrice&jsonData=' + jsonData,
					successFunc = function (text) {
						$('.currentPrice').text (text);
					};
				$.ajax ({
					url: '//' + document.domain + '/ajax',
					type: 'GET',
					timeout: 5000,
					data: sendData,
					success : successFunc
				});
			},
			generate_services : function () {
				var rows = {};
				rows = {
					surgutchId : 1,
					smellId : 1,
					mealId : -1, // не вибрано, значить -1
					burnt_edgesId : 1,
					delivery : {
						id : 2,
						address : 'м. Київ, вул. Київська 21',
						nameWhom : 'Софія Крушельницька'
					}
				};
				return rows;
			},
			generate_letter : function () {
				var rows = {},
					text = $('.text-letter-content').html ();
				rows = {
					templateId : SmartCore.globals.thisTemplateId,
					customerText : text,
					commentsPersonalText : text
				};

				if (SmartCore.globals.personalText === true && SmartCore.globals.thisTemplateId == -1)
					rows.customerText = '';
				else
					rows.commentsPersonalText = '';
				console.log(rows);
				return rows;
			},
			generate_contacts : function () {
				var rows = {};
				rows = {
					email : 'den@lux-blog.org',
					phone : '097 888 88 44',
					name : 'Lacosta'
				};
				return rows;
			},
			visitor : function () {
				// stubs
				var $services = SmartCore.constructor.validator.generate_services(),
					$letter = SmartCore.constructor.validator.generate_letter();

				SmartCore.constructor.validator.valid_all($services, $letter);
				SmartCore.constructor.validator.get_price($services, $letter);
			}
		}
    },
    navigation : {
        menuAnimation : function(){
	        $('.to-about').on('click', function () {
		        var target = '.aboutBg';
		        $('html, body').animate({scrollTop: $(target).offset().top}, 300);
	        });

            $('.to-warranty').on('click', function () {
                var target = '.warranty';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-constructor').on('click', function () {
                var target = '.constructor';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-contacts').on('click', function () {
                var target = 'footer';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-samples').on('click', function () {
                var target = '.photos';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-process').on('click', function () {
                var target = '.steps';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });

            $('.to-package').on('click', function () {
                var target = '.packages';
                $('html, body').animate({scrollTop: $(target).offset().top}, 300);
            });
        }
    },
	services : {
		InterKassa : {
			dataStab : {
				services : {
                    surgutchId : 1,
                    smellId : 1,
                    mealId : -1, //не вибрано, значить -1
                    burnt_edgesId : 1,
                    delivery : {
                        id : 2,
                        address : 'м. Київ, вул. Київська 21',
                        nameWhom : 'Софія Крушельницька'
                    }
				},
				letter : {
                    templateId : 3,
                    customerText : 'Кохана, подай свій мобільний, я хочу побачить від кого прийшла смс-ка',
                    commentsPersonalText : 'Напишіть мені лист'
				},
				customerContacts : {
                    email : 'den@lux-blog.org',
                    phone : '097 888 88 44',
                    name : 'Lacosta'
				}
			},
			redirect : function ($services, $letter, $customerContacts) {
				var url = '//' + document.domain + '/ajax?action=InterKassa&method=redirect&jsonData=',
					jsonDataArray = {
						services: $services,
						letter: $letter,
						customerContacts: $customerContacts
					};
				var jsonData = JSON.stringify(jsonDataArray);
				window.location.href = url + jsonData;
			},
			respTrue : function () {

			},
			respFalse : function () {

			},
			respPending : function () {

			}
		}
	}
};