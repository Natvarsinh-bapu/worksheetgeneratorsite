$(document).ready(function () {
    let curr_path = window.location.pathname;
    let path_arr = curr_path.split('/');
    let user_type = path_arr[1];

    //CODE FOR IMAGES MODEL
    var baseUrl = window.location.origin;

    //OPEN IMAGES MODAL
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
        el.append(
            '<img src="' + img + '" height="100%" width="100%">'
        );
        $('#images_modal_layout').modal('hide');
    });

    //for hide show wait button
    $(document).on('click', '#worksheet_submit', function () {
        $(document).find('#worksheet_wait').show();
        $(this).hide();

        setTimeout(() => {
            $(document).find('#worksheet_wait').hide();
            $(document).find('#worksheet_submit').show();
        }, 7000);
    });

    //api for images
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
            success: function (response) {
                if (response.success) {
                    $(document).find('#load_more_images').attr('data-id', response.last_id);
                    var images = response.images;
                    if (images.length > 0) {
                        $.each(images, function (index, value) {
                            $(document).find('#append_images_div').append(
                                '<div class="col-md-3 _images_for_select" style="height:100px;width:100px;margin-bottom:10px;cursor:pointer;">' +
                                '<img src="' + value.image_url + '" height="100%" width="100%">' +
                                '</div>'
                            );
                        });
                    } else {
                        $(document).find('#load_more_images').hide();
                    }
                }
            },
            error: function () {
                console.log('ERROR');
            }
        });
    }

    let load_more = $(document).find('#load_more_images');
    if (load_more.length > 0) {
        let last_id = load_more.attr('data-id');
        getImagesForAppend(last_id); //call function
    }

    $(document).on('click', '#load_more_images', function () {
        let last_id = $(this).attr('data-id');
        getImagesForAppend(last_id); //call function
    });


    //CODE FOR PDF GENERATE & SAVE DATA
    function saveDiv() {
        const element = document.getElementById("print_div");
        var opt = {
            margin: 10,
            filename: 'worksheet.pdf',
            jsPDF: {
                orientation: 'p',
                unit: 'mm',
                format: 'a4',
                floatPrecision: 16 // or "smart", default is 16
            }
        };

        // New Promise-based usage:
        html2pdf().from(element).set(opt).save();
    }

    //save worksheet html & png
    function worksheetHtmlPng() { 
        let ele_div = document.getElementById("print_div");
        let question = $("input[name='question']").val();
        let html = ele_div.innerHTML;
        let base64string = $(document).find('#img_val').val();

        if(base64string == '') {
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
                success: function (response) {
                    $(document).find('#img_val').val('');
                    console.log(response.success);
                },
                error: function () {
                    console.log('ERROR');
                }
            });
        }
    }

    $(document).on('click', '#print_pdf', function () {
        html2canvas(document.getElementById("print_div"), {
            onrendered: function (canvas) {
                document.getElementById('img_val').value = canvas.toDataURL("image/png");
            }
        })

        $(this).hide();
        $(document).find('#print_pdf_wait').show();

        setTimeout(() => {
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