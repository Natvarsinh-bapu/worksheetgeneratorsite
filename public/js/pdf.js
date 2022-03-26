/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pdf.js":
/*!*****************************!*\
  !*** ./resources/js/pdf.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  var curr_path = window.location.pathname;
  var path_arr = curr_path.split('/');
  var user_type = path_arr[1]; //CODE FOR IMAGES MODEL

  var baseUrl = window.location.origin; //OPEN IMAGES MODAL

  var current_clicked = 0;
  $(document).on('click', '._image_box', function () {
    $('#images_modal_layout').modal('show');
    current_clicked = $(this).attr('current-click');
  });
  $(document).on('click', '._images_for_select', function () {
    var img = $(this).children('img').attr('src');
    var el = $(document).find('#' + current_clicked);
    var img_textbox = $(document).find('.' + current_clicked);
    img_textbox.val(img);
    el.empty();
    el.append('<img src="' + img + '" height="100%" width="100%">');
    $('#images_modal_layout').modal('hide');
  }); //for hide show wait button

  $(document).on('click', '#worksheet_submit', function () {
    $(document).find('#worksheet_wait').show();
    $(this).hide();
    setTimeout(function () {
      $(document).find('#worksheet_wait').hide();
      $(document).find('#worksheet_submit').show();
    }, 7000);
  }); //api for images

  function getImagesForAppend(last_id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: baseUrl + '/' + user_type + '/get-images-for-appeds',
      type: 'POST',
      data: {
        last_id: last_id
      },
      cache: false,
      success: function success(response) {
        if (response.success) {
          $(document).find('#load_more_images').attr('data-id', response.last_id);
          var images = response.images;

          if (images.length > 0) {
            $.each(images, function (index, value) {
              $(document).find('#append_images_div').append('<div class="col-md-3 _images_for_select" style="height:100px;width:100px;margin-bottom:10px;cursor:pointer;">' + '<img src="' + value.image_url + '" height="100%" width="100%">' + '</div>');
            });
          } else {
            $(document).find('#load_more_images').hide();
          }
        }
      },
      error: function error() {
        console.log('ERROR');
      }
    });
  }

  var load_more = $(document).find('#load_more_images');

  if (load_more.length > 0) {
    var last_id = load_more.attr('data-id');
    getImagesForAppend(last_id); //call function
  }

  $(document).on('click', '#load_more_images', function () {
    var last_id = $(this).attr('data-id');
    getImagesForAppend(last_id); //call function
  }); //CODE FOR PDF GENERATE & SAVE DATA

  function saveDiv() {
    var element = document.getElementById("print_div");
    var opt = {
      margin: 10,
      filename: 'worksheet.pdf',
      jsPDF: {
        orientation: 'p',
        unit: 'mm',
        format: 'a4',
        floatPrecision: 16 // or "smart", default is 16

      }
    }; // New Promise-based usage:

    html2pdf().from(element).set(opt).save();
  } //save worksheet html & png


  function worksheetHtmlPng() {
    var ele_div = document.getElementById("print_div");
    var question = $("input[name='question']").val();
    var html = ele_div.innerHTML;
    var base64string = $(document).find('#img_val').val();

    if (base64string == '') {
      window.setTimeout(worksheetHtmlPng, 500);
    } else {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url: baseUrl + '/' + user_type + '/save-html-worksheet',
        type: 'POST',
        data: {
          html: html,
          question: question,
          base64string: base64string
        },
        cache: false,
        success: function success(response) {
          $(document).find('#img_val').val('');
          console.log(response.success);
        },
        error: function error() {
          console.log('ERROR');
        }
      });
    }
  }

  $(document).on('click', '#print_pdf', function () {
    html2canvas(document.getElementById("print_div"), {
      onrendered: function onrendered(canvas) {
        document.getElementById('img_val').value = canvas.toDataURL("image/png");
      }
    });
    $(this).hide();
    $(document).find('#print_pdf_wait').show();
    setTimeout(function () {
      $(document).find('#print_pdf_wait').hide();
      $(document).find('#print_pdf').show();
    }, 2000);
    worksheetHtmlPng(); //call function

    saveDiv(); //call function
  });
  /**-----------------------------------------------------------------------
  | CODE FOR UPLOAD WORKSHEET SUBMIT FORM 
  -----------------------------------------------------------------------*/

  $(document).ready(function () {
    $(document).on('change', '#worksheet_upload_btn', function () {
      $(document).find('.upload-btn-wrapper').hide();
      $(document).find('._upload_wait').show();
      $(document).find('#upload_worksheet_form').submit();
    });
  });
});

/***/ }),

/***/ 4:
/*!***********************************!*\
  !*** multi ./resources/js/pdf.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\worksheetgenerator\resources\js\pdf.js */"./resources/js/pdf.js");


/***/ })

/******/ });