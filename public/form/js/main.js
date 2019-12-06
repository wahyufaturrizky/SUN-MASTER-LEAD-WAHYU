
/**
 * Tuna Signup Form Wizard
 * @type Javascript Class
 */

var tunaWizard = {
    stepCount: 0,
    slider:null,
    /**
     * Resize for Responsive
     */
    setResponsive: function () {
        var self = this;
        var windowHeight = $(window).height();
        var windowWidth = $(window).width();
        windowHeight = windowHeight > 360 ? windowHeight : 360;
        var tunaContainer = $(".tuna-signup-container");
        var tunaLeft = $(".tuna-signup-left");
        var tunaRight = $(".tuna-signup-right");

        if (windowWidth >= 768) {
            tunaContainer.add(tunaLeft).add(tunaRight).innerHeight(windowHeight);
        } else {
            tunaContainer.add(tunaLeft).add(tunaRight).css("height", "1000px");
        }

        //Testimonail Slider Show/Hide
        try {
            var sliderContainer = $(".tuna-slider-container");
            if (windowHeight < 600 || windowWidth < 768) {
                sliderContainer.hide();
            } else {
                sliderContainer.show();
                //Reload slider because of hidden
                self.slider.reloadSlider();
            }
        } catch {}
        if (windowHeight < 400) {
            $(".button-container").css("bottom", "50px");
        }

    },
    /**
     * Change Step
     * @param int currentStep
     * @param int nextStep
     * @returns {void|Boolean}
     */
    changeStep: function (currentStep, nextStep) {
        var self = this;

        if (nextStep <= 0 && nextStep > 4) {
            return false;
        }

        // //Validations
        // if (nextStep === 2) {
        //     // if ($("#tn_name").val().trim() === "") {
        //     //     self.setInputError($("#tn_name"), $(".help-error-name"));
        //     //     return;
        //     // }
            
        //     // if ($("#tn_email").val().trim() === "" || !self.isEmail($('#tn_email').val().trim())) {
        //     //     self.setInputError($("#tn_email"), $(".help-error-email"));
        //     //     return;
        //     // }
            
        //     // if ($("#tn_phone").val().trim() === "") {
        //     //     self.setInputError($("#tn_phone"), $(".help-error-phone"));
        //     //     return;
        //     // }
        // }

        // //Validations
        // if (nextStep === 3) {
            
        //     if ($("#tn_birth").val().trim() === "0000-00-00" || moment($("#tn_birth").val().trim(), 'YYYY-MM-DD',true).isValid() == false) {
        //         self.setInputError($("#tn_birth"), $(".help-error-birth"));
        //         return;
        //     } else if (new Date($("#tn_birth").val().trim()) > new Date()) {
        //         self.setInputError($("#tn_birth"), $(".help-error-birth"));
        //         return;
        //     } else {
        //         $(".help-error-birth").hide()
        //     }
            
        //     if ($("input[name='tn_gender']:checked").val() === "") {
        //         self.setInputError($("input[name='tn_gender']"), $(".help-error-gender"));
        //         return;
        //     }

        //     if ($("#tn_parents_phone").val().trim() === "") {
        //         self.setInputError($("#tn_parents_phone"), $(".help-error-parents-phone"));
        //         return;
        //     }
        // }

        // //Validations
        // if (nextStep === 4) {
            
        //     if ($("#tn_parents_name").val().trim() === "") {
        //         self.setInputError($("#tn_parents_name"), $(".help-error-parents-name"));
        //         return;
        //     }

        //     if ($("#tn_address").val().trim() === "") {
        //         self.setInputError($("#tn_address"), $(".help-error-address"));
        //         return;
        //     }

        //     if ($("#tn_zipcode").val().trim() === "") {
        //         self.setInputError($("#tn_zipcode"), $(".help-error-zipcode"));
        //         return;
        //     }
        // }

        // //Validations
        // if (nextStep === 5) {
            
        //     if ($("#tn_edu_grade").val().trim() === "") {
        //         self.setInputError($("#tn_edu_grade"), $(".help-error-edu-grade"));
        //         return;
        //     }

        //     if ($("#tn_school_name").val().trim() === "") {
        //         self.setInputError($("#tn_school_name"), $(".help-error-school-name"));
        //         return;
        //     }
        // }

        // //Validations
        // if (nextStep === 6) {
            
        //     if ($("#tn_major").val().trim() === "") {
        //         self.setInputError($("#tn_major"), $(".help-error-major"));
        //         return;
        //     }

        //     if ($("#tn_destination").val().trim() === "") {
        //         self.setInputError($("#tn_destination"), $(".help-error-destination"));
        //         return;
        //     }

        //     if ($("#tn_program").val().trim() === "") {
        //         self.setInputError($("#tn_program"), $(".help-error-program"));
        //         return;
        //     }
        // }

        // if (nextStep === 7) {
            
        //     if ($("#tn_marketing").val().trim() === "") {
        //         self.setInputError($("#tn_marketing"), $(".help-error-marketing"));
        //         return;
        //     }
        // }

        // //Checboxes validation
        // if (nextStep === 3) {
        //     if ($("input[name='tn_hobbies[]']:checked").length == 0) {
        //         self.setInputError($("input[name='tn_hobbies[]']"));
        //         return;
        //     }
        // }
        // //Radio validation
        // if (nextStep === 4) {
        //     if ($("input[name='tn_gender']:checked").val() === "") {
        //         self.setInputError($("input[name='tn_gender']"));
        //         return;
        //     }
        // }
        // if (nextStep === 5) {
        //     if ($("#tn_sport").val().trim() === "") {
        //         self.setInputError($("#tn_sport"));
        //         return;
        //     }
        // }

        //Change Step
        if (nextStep > currentStep) {
            $(".step-active").removeClass("step-active").addClass("step-hide");
        } else {
            $(".step-active").removeClass("step-active");
        }

        var nextStepEl = $(".step[data-step-id='" + nextStep + "']");
        nextStepEl.removeClass("step-hide").addClass("step-active");

        //Focus Input
        window.setTimeout(function () {
            if (nextStep !== self.stepCount) {
                // nextStepEl.find("input").focus();
            }
        }, 500);

        var stepCountsEl = $(".steps-count");
        if (nextStep === self.stepCount) {
            // stepCountsEl.html("CONFIRM DETAILS");
            $(".button-container").hide();
            var stepConfirm = $(".step-confirm");
            // stepConfirm.find("input[name='name']").val($("#tn_name").val());

            // var hobbies = $("input[name='tn_hobbies[]']:checked").map(function() {
            //     return this.value;
            // }).get();
            // stepConfirm.find("select[name='hobbies[]']").selectpicker("val", hobbies);
            // stepConfirm.find("select[name='gender']").selectpicker("val", $("input[name='tn_gender']:checked").val());
            // stepConfirm.find("select[name='sport']").selectpicker("val", $("#tn_sport").val());

        }

        //Current Step Number update
        stepCountsEl.find("span.step-current").text(nextStep);

        //Hide prevButton if we are in first step
        var prevStepEl = $(".prevStep");
        if (nextStep === 1) {
            prevStepEl.hide();
        } else {
            prevStepEl.css("display", "inline-block");
        }
    },
    /**
     * Show Validation Message
     * @param HtmlElement el
     * @returns void
     */
    setInputError: function(el, helper) {
        el.addClass("input-error");
        helper.show()
    },
    /**
     * Check email is valid or not
     * @param String value
     * @returns Boolean
     */
    isEmail: function(value) {
        value = value.toLowerCase();
        var reg = new RegExp(/^[a-z]{1}[\d\w\.-]+@[\d\w-]{3,}\.[\w]{2,3}(\.\w{2})?$/);
        return reg.test(value);
    },
    /**
     * Executes Signup Wizard
     * @returns void
     */
    start: function() {
        var self = this;
        /**
         * Testimonial Slider - Uses bxslider jquery plugin
         */
        try {
            self.slider = $('.tuna-slider').bxSlider({
                controls: false, // Left and Right Arrows
                auto: true, // Slides will automatically transition
                mode: 'horizontal', // horizontal,vertical,fade
                pager: true, // true, a pager will be added
                speed: 500, // Slide transition duration (in ms)
                pause: 5000 // The amount of time (in ms) between each auto transition
            });
        } catch {}

        //Jquery Uniform Plugin
        $(".tuna-signup-container input[type='checkbox'],.tuna-signup-container input[type='radio'],.tuna-signup-container input[type='file'],.select").uniform();

        // Focuses on name input, when page loaded
        window.setTimeout(function() {
            // $("#tn_name").focus();
        }, 500);

        // Responsive
        self.setResponsive();
        $(window).resize(function() {
            self.setResponsive();
        });

        // Steps Count
        self.stepCount = $(".tuna-steps .step").length;
        $(".step-count").text(self.stepCount);

        // Next Step
        // $(".nextStep").on("click", function() {
        //     var currentStep = $(".step-active").attr("data-step-id")
        //     var nextStep = parseFloat(currentStep) + 1;
        //     self.changeStep(currentStep, nextStep);
        // });

        // Prev Step
        // $(".prevStep").on("click", function() {
        //     var currentStep = $(".step-active").attr("data-step-id")
        //     var nextStep = parseFloat(currentStep) - 1;
        //     self.changeStep(currentStep, nextStep);
        //     $('.nextStep').removeAttr("disabled")
        // });

        // Confirm Details - Show Input
        var stepConfirm = $(".step-confirm");
        stepConfirm.find(".input-container a.editInput").on("click", function() {
            $(this).parent().find("input").focus();
        });

        // Confirm Details - Show Password
        stepConfirm.find(".input-container a.showPass").on("mousedown", function() {
            $(this).parent().find("input").attr("type", "text");
        }).mouseup(function() {
            $(this).parent().find("input").attr("type", "password");
        });

        stepConfirm.find(".input-container input").on("focus", function() {
            $(this).parent().find("a").hide();
        });

        stepConfirm.find(".input-container input").on("focusout", function() {
            if (!$(this).hasClass("confirm-input-error")) {
                $(this).parent().find("a").show();
            }
        })

        stepConfirm.find("select").on('shown.bs.select', function(e) {
            $(this).parents(".form-group").find("a.editInput").hide();
        }).on('hidden.bs.select', function(e) {
            $(this).parents(".form-group").find("a.editInput").show();
        });

        //Press Enter and go to nextStep
        // $(".step input").not(".step-confirm input").on("keypress", function(e) {
        //     if (e.keyCode === 13) {
        //         $(".nextStep").click();
        //     }
        // });

        var signupForm = $("form[name='signupForm']");
        //Press Enter and submit form
        signupForm.find("input").on("keypress", function(e) {
            if (e.keyCode === 13) {
                // signupForm.submit();
            }
        });

        //Finish Button
        $(".finishBtn").on("click", function() {
            // signupForm.submit();
        })

        // Form Submit
        // signupForm.on("submit", function(e) {

        //     e.preventDefault();

        //     $(this).find(".confirm-input-error").removeClass("confirm-input-error");

        //     var nameInput = $(this).find("input[name='name']");
        //     if (nameInput.val().trim() === "") {
        //         nameInput.addClass("confirm-input-error").focus();
        //         return;
        //     }


        //     var hobbyInput = $(this).find("select[name='hobbies[]']");
        //     console.log(hobbyInput);
        //     if (hobbyInput.find("option:selected").length === 0) {
        //         //add class to parent element, because this is bootstrap-select.
        //         hobbyInput.parents(".bootstrap-select").addClass("confirm-input-error").focus();
        //         hobbyInput.selectpicker('toggle');
        //         return;
        //     }

        //     var genderInput = $(this).find("select[name='gender']");
        //     if (genderInput.val() === "") {
        //         genderInput.addClass("confirm-input-error").focus();
        //         return;
        //     }

        //     var sportInput = $(this).find("select[name='sport']");
        //     if (sportInput.val() === "") {
        //         sportInput.addClass("confirm-input-error").focus();
        //         return;
        //     }

        //     if (!$("input[name='agreement']").prop("checked")) {
        //         swal({
        //             title: "Warning!",
        //             text: "You must agree with the terms and conditions.",
        //             type: "warning",
        //             confirmButtonText: "Ok"
        //         });
        //         return;
        //     }

        //     swal({
        //         title: null,
        //         text: "<img class='tuna_loading' src='images/loading.svg'/> Saving...",
        //         html: true,
        //         showConfirmButton: false
        //     });

        //     //Send form to php file
        //     $.post("../php/smtp.php", $(this).serialize(), function(result) {
        //         if (result.success) {
        //             swal({
        //                 title: "Success",
        //                 text: "Your information submitted successfully!",
        //                 type: "success",
        //                 confirmButtonText: "Ok"
        //             });
        //         } else {
        //             swal({
        //                 title: "Error!",
        //                 text: result.msg,
        //                 type: "error",
        //                 confirmButtonText: "Ok"
        //             });
        //         }
        //     }, 'json');

        // });


    },
}


/**
 * Material Input 
 * @returns object
 */
$.fn.materialInput = function() {

    var label;
    var el = this;

    el.find('input.formInput').keydown(function(e) {
        el.setLabel(e.target);
        el.checkFocused(e.target);
    });

    el.find('input.formInput').focusout(function(e) {
        el.setLabel(e.target);
        el.checkUnFocused(e.target);
    });

    this.setLabel = function(target) {
        label = el.find('label[for=' + target.id + ']');
    };

    this.getLabel = function() {
        return label;
    };

    this.checkFocused = function(target) {
        el.getLabel().addClass('active', '');
        $(target).removeClass("input-error");
        $(target).parent().find(".info").show();
    };

    this.checkUnFocused = function(target) {
        if ($(target).val().length === 0) {
            el.getLabel().removeClass('active');
        }
    };
};


$(document).ready(function() {

    /**
     * Page Loader
     * If you remove loader, you can delete .tuna-loader-container element from Html, and delete this two rows.
     */
    $(".tuna-loader-container").fadeOut("slow");
    $(".tuna-signup-container").show();


    /**
     * Material Inputs
     * Makes, inputs in selected element material design.
     */
    $(".tuna-steps").materialInput();

    /**
     * Bootstrap Select Plugin
     */
    $(".selectpicker").selectpicker();

    /**
     * Tuna Signup Form Wizard
     * Let's Start
     */
    tunaWizard.start();

});
