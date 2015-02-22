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
	},
	globals : {
		lastOpenedSubCat : undefined,
		thisTemplateId : 0
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
					text = textContainerObj.html ();
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
			viewText : function (id, text, textContainerObj) {
				var active = 'active';
				$('.text-letter-content').html (text);
				$('.preview-box.active').removeClass(active);
				textContainerObj.parent().addClass (active);
				SmartCore.globals.thisTemplateId = id;
			}
		},
		switcher : {
			vars : {
				step1 : undefined,
				step2 : undefined,
				step3 : undefined,
				previous : undefined,
				next : undefined,
				toPay : undefined
			},
			init : function () {
				this.vars.step1     =  $('.constructor-navigator.step1');
				this.vars.step2     =  $('.constructor-navigator.step2');
				this.vars.step3     =  $('.constructor-navigator.step3');
				this.vars.previous  =  $('.constructor-switcher.previous');
				this.vars.next      =  $('.constructor-switcher.next');
				this.vars.toPay     =  $('.constructor-switcher.toPay');
			},
			previousHandler : function () {

			},
			nextHandler : function () {

			},
			toPayHandler : function () {

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
    testAndriy: {
        ajaxTest: function() {
            var sendData = 'action=GetText&id=1';
            $.ajax({
                url: '//' + document.domain + '/ajax',
                type: 'GET',
                timeout: 5000,
                data: sendData,
                success : function (msg) {
                    var response = msg;
                    console.log(response);
                }
            });
			return;
        }
    }
};