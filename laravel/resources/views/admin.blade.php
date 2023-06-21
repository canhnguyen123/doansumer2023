<!DOCTYPE html>

<head>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('BE/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('BE/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('BE/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('BE/css/font.css') }}" type="text/css" />
    <link href="{{ asset('BE/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('BE/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('BE/css/monthly.css') }}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="{{ asset('BE/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('BE/js/raphael-min.js') }}"></script>
    <script src="{{ asset('BE/js/morris.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"
        integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"
        integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <section id="container">
        <!--header start-->
        @include('admin_include.menu_top')
        <!--header end-->
        <!--sidebar start-->
        <aside>
            @include('admin_include.header')
        </aside>
        @yield('admin_content')

    </section>

    <script src="{{ asset('BE/js/bootstrap.js') }}"></script>
    <script src="{{ asset('BE/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('BE/js/scripts.js') }}"></script>
    <script src="{{ asset('BE/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('BE/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('BE/js/ckediter.js') }}"></script>
    <script src="{{ asset('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.7.0/firebase-storage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uuid@8.3.2/dist/umd/uuidv4.min.js"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/he/1.2.0/he.js"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"
        integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"
        integrity="sha512-eP8DK17a+MOcKHXC5Yrqzd8WI5WKh6F1TIk5QZ/8Lbv+8ssblcz7oGC8ZmQ/ZSAPa7ZmsCU4e/hcovqR8jfJqA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyBm2amWU-VobIc5AcDrckAZRGTKWNM_iD0",
            authDomain: "loco-7d8c6.firebaseapp.com",
            projectId: "loco-7d8c6",
            storageBucket: "loco-7d8c6.appspot.com",
            messagingSenderId: "935133300037",
            appId: "1:935133300037:web:97c2523fd818d9eee72a2c",
            measurementId: "G-VQBY84PHMG"
        };

        firebase.initializeApp(firebaseConfig);
    </script>
    <script type="text/javascript">
        // $('.res-them').slick({
        //     slidesToShow: 4,
        //     slidesToScroll: 1,
        //     arrows: true,
        //     speed: 300
        // });

        // var filtered = false;

        // $('.js-filter').on('click', function () {
        //     if (filtered === false) {
        //         $('.res-them').slick('slickFilter', ':even');
        //         $(this).text('Unfilter Slides');
        //         filtered = true;
        //     } else {
        //         $('.res-them').slick('slickUnfilter');
        //         $(this).text('Filter Slides');
        //         filtered = false;
        //     }
        // });
    </script>
    <script>
        function uploadImage(event) {
            event.preventDefault();
            const category_code = $('#category_code').val();
            const phanloai_code = $('#phanloai_code').val();
            const theloai_name = $('#theloai_name').val();

            const ref = firebase.storage().ref();
            const file = document.querySelector("#photo").files[0];
            //const file=$('#photo').files[0];
            const name = +new Date() + "-" + file.name;
            const metadata = {
                contentType: file.type
            };



            const task = ref.child(name).put(file, metadata);
            task
                .then(snapshot => snapshot.ref.getDownloadURL())
                .then(url => {
                    console.log(url);
                    var imageURL = url;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('post_theloai_add') }}",

                        data: {
                            content: imageURL,
                            category_code: category_code,
                            phanloai_code: phanloai_code,
                            theloai_name: theloai_name
                        },
                        success: function(response) {
                            if (response.success) {
                                console.log("thêm thành công");
                                alert(response.message);
                                window.location.href = "{{ route('theloai_list') }}";
                            } else {
                                console.log("thêm thất bại");
                                alert('Thêm thành công');
                                window.location.href = "{{ route('theloai_add') }}";
                            }

                        },
                        error: function(xhr, status, error) {
                            console.log('Lỗi: ' + error);
                        }
                    });
                })
                .catch(console.error);
        }

        function uploadImages() {
            const files = Array.from(document.getElementById("file-upload-product").files);
            const uploadPromises = [];
            const ref = firebase.storage().ref();

            files.forEach((file) => {
                const name = +new Date() + "-" + file.name;
                const metadata = {
                    contentType: file.type
                };

                const task = ref.child(name).put(file, metadata);
                const uploadPromise = task
                    .then((snapshot) => snapshot.ref.getDownloadURL())
                    .catch(console.error);

                uploadPromises.push(uploadPromise);
            });

            Promise.all(uploadPromises)
                .then((urls) => {
                    const statusElement = document.getElementById("upload-status");
                    statusElement.innerHTML = "Thêm thành công";
                    // Các hành động khác tùy ý

                })
                .catch(console.error);
        }

        function uploadImage_theloai(event) {
            event.preventDefault();
            var fileInput = document.getElementById('file-upload-up');
            const category_code = $('#category_code_up').val();
            const phanloai_code = $('#phanloai_code_up').val();
            const theloai_name = $('#theloai_name_up').val();
            // var theloai_status = {};
            const old_url = $("#theloai-img-up").attr('src');
            // var theloai_status_ed = ($("#theloai_status_up").prop("checked")) ? { "on": true } : {};
            var theloai_showhome_ed = ($("#theloai_showhome_up").prop("checked")) ? {
                "on": true
            } : {};
            var theloai_showhome = JSON.stringify(theloai_showhome_ed);

            // alert(theloai_status)
            // const theloai_status = $('#theloai_status_up').is(':checked') ? "on" : "";
            // var isChecked = $("#theloai_status_up").prop("checked");
            // var theloai_status = isChecked ? {} : {"on"};
            // alert(theloai_status)
            const theloai_id = $('.dis-none').text();
            var updateUrl = "{{ route('post_theloai_update', ['theloai_id' => 0]) }}";
            var updateUrlnew = updateUrl.slice(0, -1) + theloai_id;
            // alert(updateUrlnew)
            if (fileInput.files.length > 0) {
                const ref = firebase.storage().ref();
                const file = document.querySelector("#file-upload-up").files[0];
                const name = +new Date() + "-" + file.name;
                const metadata = {
                    contentType: file.type
                };
                const task = ref.child(name).put(file, metadata);
                task
                    .then(snapshot => snapshot.ref.getDownloadURL())
                    .then(url => {
                        console.log(url);
                        var imageURL = url;
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: updateUrlnew,
                            data: {
                                imageURL: imageURL,
                                category_code: category_code,
                                phanloai_code: phanloai_code,
                                theloai_name: theloai_name,
                                theloai_showhome: theloai_showhome
                            },
                            success: function(response) {
                                if (response.success) {
                                    console.log("thêm thành công");
                                    alert(response.message);
                                    window.location.href = "{{ route('theloai_list') }}";
                                } else {
                                    console.log("thêm thất bại");
                                    alert(response.message);
                                    window.location.href = "{{ route('theloai_list') }}";
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log('Lỗi: ' + error);
                            }
                        });
                    })
                    .catch(console.error);
            } else {
                // alert("link :"+old_url +"--category_code"+category_code
                //          +"--phanloai_code"+phanloai_code+"--theloai_name"+theloai_name+"----theloai_status"+theloai_status)
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });
                $.ajax({
                    type: "POST",
                    url: updateUrlnew,

                    data: {
                        imageURL: old_url,
                        category_code: category_code,
                        phanloai_code: phanloai_code,
                        theloai_name: theloai_name,
                        theloai_showhome: theloai_showhome
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log("thêm thành công");
                            alert(response.message);
                            window.location.href = "{{ route('theloai_list') }}";
                        } else {
                            console.log("thêm thất bại");
                            alert(response.message);

                            window.location.href = "{{ route('theloai_list') }}";

                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Lỗi: ' + error);

                    }
                });
            }


        }


        function uploadImage_banner(event) {
            event.preventDefault();
            const banner_mota_mh = CKEDITOR.instances.mota_banner.getData();
            const banner_mota = he.decode(banner_mota_mh);
            const ref = firebase.storage().ref();
            const file = document.querySelector("#file-upload-banner").files[0];
            const name = +new Date() + "-" + file.name;
            const metadata = {
                contentType: file.type
            };
            const task = ref.child(name).put(file, metadata);
            task
                .then(snapshot => snapshot.ref.getDownloadURL())
                .then(url => {
                    // console.log(url);
                    // alert(url);
                    var imageURL = url;
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: "{{ route('post_banner_add') }}",
                        data: {
                            banner_img: imageURL,
                            banner_mota: banner_mota
                            // banner_img: '3213213',
                            // banner_mota:'12431413'
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.message);
                                window.location.href = "{{ route('banner_list') }}";
                            } else {
                                alert(response.message);
                                window.location.href = "{{ route('banner_list') }}";
                            }

                        },
                        error: function(xhr, status, error) {
                            console.log('Lỗi: ' + error);
                            alert('Lỗi: ' + error + "link:  " + imageURL + " mô tả  " + banner_mota)
                        }
                    });
                })
                .catch(console.error);
        }
        function select_quantity() {
            console.log('321312')
   
        }
        var itemCount = 1; // Biến đếm ban đầu
        var addedItems = []; // Mảng lưu trữ các mặt hàng đã được thêm vào

        function them_slPRo(event) {
            event.preventDefault();

            var res_them = $('.res-them');
            var colorItem = $('input[name="product-color-item"]:checked').val();
            var sizeItem = $('input[name="product-size-item"]:checked').val();
            var quantityItem = $('#quantityItem').val();

            // Kiểm tra nếu màu và kích thước đã được thêm vào trước đó
            if (isItemAdded(colorItem, sizeItem)) {
                alert("Màu và kích thước đã được thêm vào trước đó!");
                return;
            }

            var newDiv = $('<div></div>').addClass('item-req').attr('id', 'item-' + itemCount);
            newDiv.append('<i class="fa-solid fa-x close-item-product"></i>');
            newDiv.append('<div class="item-res-pro"><p>Color</p>: <p class="color-item-Pro" id="color-product' +
                itemCount + '">' + colorItem + '</p></div>');
            newDiv.append('<div class="item-res-pro"><p>size</p>: <p class="size-item-Pro" id="size-product' + itemCount +
                '">' + sizeItem + '</p></div>');
            newDiv.append('<div class="item-res-pro"><p>SL</p>: <p class="quantyti-item-Pro" id="quantity-product' +
                itemCount + '">' + quantityItem + '</p></div>');
            itemCount++;

            // Thêm mặt hàng vào mảng
            addedItems.push({
                color: colorItem,
                size: sizeItem
            });

            // Thêm chuỗi HTML mới vào nội dung của res_them
            res_them.html(res_them.html() + newDiv[0].outerHTML);
        }

        function isItemAdded(color, size) {
            for (var i = 0; i < addedItems.length; i++) {
                if (addedItems[i].color === color && addedItems[i].size === size) {
                    return true;
                }
            }
            return false;
        }


        function select_quantity(){
          
        }
        function deleteQuantity(quantityId, productId) {
            if (confirm('bạn có muốn xóa hay k')) {
                var url = "{{ route('delete_quantity') }}?quantity_id=" + quantityId + "&product_id=" + productId;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                            if (response.success == true) {
                                alert(response.message);
                                updateQuantityList(response.list_quantityNew);
                            } else {
                                alert(response.message);
                            }
                        },
                    error: function(xhr, status, error) {
                        console.log('Lỗi: ' + error);
                    }
                });
            }

        }

        function updateQuantityList(list_quantityNew) {
            // Xóa danh sách hiện tại
            $('.item-req').remove();

            // Thêm các mục mới vào danh sách
            $.each(list_quantityNew, function(index, item) {
                var html = '<div class="item-req">' +
                    '<i class="fa-solid fa-x close-item-product"></i>' +
                    '<div class="item-res-pro">' +
                    '<p>Color</p>: <p>' + item.quantity_color + '</p>' +
                    '</div>' +
                    '<div class="item-res-pro">' +
                    '<p>size</p>: <p class="size-item-Pro">' + item.quantity_size + '</p>' +
                    '</div>' +
                    '<div class="item-res-pro">' +
                    '<p>SL</p>: <p class="quantyti-item-Pro">' + item.quantity_sl + '</p>' +
                    '</div>' +
                    '<div class="item-icon">' +
                    '<i class="fa-solid fa-pen"></i>' +
                    '<i onclick="delete_quantity(' + item.quantity_id + ',' + item.product_id +
                    ')" class="fa-sharp fa-solid fa-trash"></i>' +
                    '</div>' +
                    '</div>';
                $('.res-them').append(html);
            });
        }
        $('.res-them').on('click', '.close-item-product', function() {
            $(this).parent().remove();
        });
        // $('#product_price').keyup(function(){
        //     var product_price = $(this).val();
        //     if (isNaN(product_price)) {
        //         $('#err-product-price').text("Bạn không thể nhập kí tự gì ngoài số");

        //     } else {
        //         $('#err-product-price').text(""); // Xóa nội dung lỗi khi giá trị hợp lệ
        //     }
        // });
        // $('#quantityItem,#product_price').on('keypress input', function(e) {
        //     var input = $(this).val();

        //     // Kiểm tra regular expression để chỉ cho phép nhập số nguyên dương
        //     var regex = /^[0-9]*$/;

        //     // Kiểm tra nếu kí tự nhập không phù hợp, loại bỏ nó
        //     if (!regex.test(input)) {
        //         e.preventDefault();
        //         $(this).val(input.replace(/[^0-9]/g, ''));
        //     }
        // });
        $('#quantityItem, #product_price').keyup(function(e) {
            var product_price = $('#product_price').val();
            var quantity_Item = $('#quantityItem').val();
            var regex = /^[0-9]*$/;

            if (!regex.test(product_price)) {
                e.preventDefault();
                $(this).val(product_price.replace(/[^0-9]/g, ''));
                $('#product_price').css('border', '1px solid red')
                $('#product_price_lable').css('color', 'red')
                $('#err-product-price').text("Bạn không thể nhập kí tự gì ngoài số");
            } else {
                $('#err-product-price').text(""); // Xóa nội dung lỗi khi giá trị hợp lệ
                $('#product_price').css('border', '1px solid #ccc')
                $('#product_price_lable').css('color', '#727272')
            }
        });

        function check_NAN(inputValue) {
            if (isNaN(inputValue)) {
                return false;
            } else {
                return true;
            }
        }

        function uploadImage_Product(event) {
            event.preventDefault();
            var theloai_id = $("#theloai_id").val();
            var product_name = $('#product_name').val();
            var product_price = $('#product_price').val()
            var brand_Product = $('#brand_Product').val();
            var trangthai_Product = $('#trangthai_Product').val();
            var product_code = $("#product_code").val();
            const mota_product = he.decode(CKEDITOR.instances.mota_product.getData());
            const dacdiem_product = he.decode(CKEDITOR.instances.dacdiem_product.getData());
            const baoquan_product = he.decode(CKEDITOR.instances.baoquan_product.getData());
            var check = true;
            var arr_list_item = [];
            var itemCount = 1;

            if (isNaN(product_price)) {
                check = false;
            }
            if (check == true) {
                $('.item-req').each(function() {
                    var item_content = [];
                    item_content.push($(this).find('#color-product' + itemCount).text());
                    item_content.push($(this).find('#size-product' + itemCount).text());
                    item_content.push($(this).find('#quantity-product' + itemCount).text());
                    arr_list_item = arr_list_item.concat([item_content]);
                    itemCount++;
                });
                const files = Array.from(document.getElementById("file-upload-product").files);
                const uploadPromises = [];
                const ref = firebase.storage().ref();

                files.forEach((file) => {
                    const name = +new Date() + "-" + file.name;
                    const metadata = {
                        contentType: file.type
                    };

                    const task = ref.child(name).put(file, metadata);
                    const uploadPromise = task
                        .then((snapshot) => snapshot.ref.getDownloadURL())
                        .catch(console.error);

                    uploadPromises.push(uploadPromise);
                });

                Promise.all(uploadPromises)
                    .then((urls) => {
                        const imageURLs = urls;
                        if (!Array.isArray(imageURLs)) {
                            imageURLs = [imageURLs]; // Converter em um array com um único elemento
                        }

                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('post_product_add') }}",
                            data: {
                                theloai_id: theloai_id,
                                product_name: product_name,
                                product_price: product_price,
                                brand_Product: brand_Product,
                                trangthai_Product: trangthai_Product,
                                product_code: product_code,
                                mota_product: mota_product,
                                dacdiem_product: dacdiem_product,
                                baoquan_product: baoquan_product,
                                quantity_list: JSON.stringify(arr_list_item),
                                imgs_item_product: imageURLs,
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert(response.message);
                                    window.location.href = "{{ route('product_list') }}";
                                } else {
                                    alert(response.message);
                                    window.location.href = "{{ route('product_list') }}";
                                }

                            },
                            error: function(xhr, status, error) {
                                console.log('Lỗi: ' + error);
                            }
                        });
                    })
                    .catch(console.error);
            }



        }
    </script>
    <script>
        $('.cked').change(function() {
            var $parentDiv = $(this).closest('.mg-r-l-10px');
            if ($(this).is(':checked')) {
                $parentDiv.addClass('col-2');
                $parentDiv.find('.input-chked').show();
                $parentDiv.find('.size-item-product-list').show();
            } else {
                $parentDiv.removeClass('col-2');
                $parentDiv.find('.input-chked').hide();
                $parentDiv.find('.size-item-product-list').hide();
            }
        });

        $("#category_id_Pro, #phanloai_id_Pro").change(function() {
            var category_id_Pro = $('#category_id_Pro').val();
            var phanloai_id_Pro = $('#phanloai_id_Pro').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            $.ajax({
                url: '{{ route('product_theloai') }}',
                method: 'POST',
                data: {
                    category_id: category_id_Pro,
                    phanloai_id: phanloai_id_Pro
                },
                success: function(response) {
                    console.log("Đã lấy về thành công");
                    // Xóa các tùy chọn cũ trong thẻ select
                    $('#theloai_id').empty();

                    // Đổ dữ liệu vào thẻ select
                    $.each(response, function(index, select_theloai) {
                        $('#theloai_id').append($('<option></option>').val(
                            select_theloai.theloai_id).text(select_theloai
                            .theloai_name));
                    });
                },
                error: function() {
                    console.log("gửi thất bại");
                }
            });
        });

        $('#file-upload-product').on('change', function(e) {
            $('.product-img-class').hide()
            var files = e.target.files;
            console.log(files)
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var imgSrc = event.target.result;
                    var imgElement = '<div><img src="' + imgSrc + '" alt="Image"></div>';
                    $('.slider').slick('slickAdd', imgElement);

                }
                reader.readAsDataURL(files[i]);
            }
        });

        $('.slider').slick({
            dots: false,
            arrows: true,
            prevArrow: $('.prev'),
            nextArrow: $('.next')
        });
        $('#up_theloai').click(function(event) {
            // function up_theloai(event){
            event.preventDefault();
            const theloai_id = $('.dis-none').text()
            const theloai_img = $('#theloai-img').attr('src')
            const category_code_up = $('#category_code_up').val();
            const phanloai_code_up = $('#phanloai_code_up').val()
            const file = $('#file-upload-up').val()
            //const ref = firebase.storage().ref();
            // const file = document.querySelector("#file-upload-up").files[0];
            //const file=$('#photo').files[0];
            // const name = +new Date() + "-" + file.name;
            // const metadata = {
            //    contentType: file.type
            // };
            // const task = ref.child(name).put(file, metadata);
            //   task
            //      .then(snapshot => snapshot.ref.getDownloadURL())
            //      .then(url => {
            //         console.log(url);
            //          var imageURL = url;
            //         var csrfToken = $('meta[name="csrf-token"]').attr('content');
            //            $.ajaxSetup({
            //            headers: {
            //               'X-CSRF-TOKEN': csrfToken
            //            }
            //            });
            //         $.ajax({
            //            type: "POST",
            //            url: "{{ route('post_theloai_add') }}",

            //            data: {
            //               content: imageURL,
            //               category_code:category_code,
            //               phanloai_code:phanloai_code,
            //               theloai_name:theloai_name
            //            },
            //            success: function(response) {
            //             if (response.success) {
            //               console.log("thêm thành công");
            //               alert(response.message);
            //                window.location.href = "{{ route('theloai_list') }}";
            //             }else{
            //               console.log("thêm thất bại");
            //               alert('Thêm thành công');
            //                window.location.href = "{{ route('theloai_add') }}";
            //             }

            //             },
            //            error: function(xhr, status, error) {
            //               console.log('Lỗi: ' + error);
            //            }
            //         });
            //      })
            //      .catch(console.error);
            // //  if(file==""){
            //  
            //      alert(theloai_id + "link :"+theloai_img +"----"+category_code_up+"------"+phanloai_code_up+file)

            // }
        })


        $('.uppercase').on('input', function() {
            var inputVal = $(this).val();
            $(this).val(inputVal.toUpperCase());
        });
        $('.img_child_icon').click(function() {
            var link_img = $(this).attr("src");
            $('#image-dialog img').attr('src', link_img);
            document.getElementById("image-dialog").style.display = "flex";
        });

        function closeDialog() {
            $("#image-dialog").hide()
            $(document).off("click");
        }
        $('#theloai-status-fiter').change(function() {
            var selectedValue = $('#theloai-status-fiter').val();
            var products = $('.theloai-item');

            // for (var i = 0; i < products.length; i++) {
            //   var product = products[i];
            //   var productValue = product.getAttribute("data-value");

            //   if (selectedValue === 1|| productValue === selectedValue) {
            //     product.style.display = "table-row";
            //   } else {
            //     product.style.display = "none";
            //   }

            // }
        });



        function openDialog(imageUrl) {
            var dialogImage = document.getElementById("dialog-image");
            dialogImage.src = imageUrl;
            document.getElementById("image-dialog").style.display = "flex";
        }

        function closeDialog() {
            document.getElementById("image-dialog").style.display = "none";
        }


        $(document).ready(function() {
            //BOX BUTTON SHOW AND CLOSE
            jQuery('.small-graph-box').hover(function() {
                jQuery(this).find('.box-button').fadeIn('fast');
            }, function() {
                jQuery(this).find('.box-button').fadeOut('fast');
            });
            jQuery('.small-graph-box .box-close').click(function() {
                jQuery(this).closest('.small-graph-box').fadeOut(200);
                return false;
            });

            //CHARTS
            function gd(year, day, month) {
                return new Date(year, month - 1, day).getTime();
            }

            graphArea2 = Morris.Area({
                element: 'hero-area',
                padding: 10,
                behaveLikeLine: true,
                gridEnabled: false,
                gridLineColor: '#dddddd',
                axes: true,
                resize: true,
                smooth: true,
                pointSize: 0,
                lineWidth: 0,
                fillOpacity: 0.85,
                data: [{
                        period: '2015 Q1',
                        iphone: 2668,
                        ipad: null,
                        itouch: 2649
                    },
                    {
                        period: '2015 Q2',
                        iphone: 15780,
                        ipad: 13799,
                        itouch: 12051
                    },
                    {
                        period: '2015 Q3',
                        iphone: 12920,
                        ipad: 10975,
                        itouch: 9910
                    },
                    {
                        period: '2015 Q4',
                        iphone: 8770,
                        ipad: 6600,
                        itouch: 6695
                    },
                    {
                        period: '2016 Q1',
                        iphone: 10820,
                        ipad: 10924,
                        itouch: 12300
                    },
                    {
                        period: '2016 Q2',
                        iphone: 9680,
                        ipad: 9010,
                        itouch: 7891
                    },
                    {
                        period: '2016 Q3',
                        iphone: 4830,
                        ipad: 3805,
                        itouch: 1598
                    },
                    {
                        period: '2016 Q4',
                        iphone: 15083,
                        ipad: 8977,
                        itouch: 5185
                    },
                    {
                        period: '2017 Q1',
                        iphone: 10697,
                        ipad: 4470,
                        itouch: 2038
                    },

                ],
                lineColors: ['#eb6f6f', '#926383', '#eb6f6f'],
                xkey: 'period',
                redraw: true,
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });


        });
    </script>

    <script>
        $(document).ready(function() {

            $('#search_icon').click(function() {

                $('#search_input').toggle();
                console.log('123')
            })
            $('#search_ajax_category').keyup(function() {
                if ($(this).val().length > 0) {
                    $('#close_search').show();
                } else {
                    $('#close_search').hide();
                }
                var content = $('#search_ajax_category').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('category_search') }}",
                    data: {
                        content: content
                    },
                    success: function(data) {
                        $('#category_list_table').html(data);
                    },

                });
            })


            $('#search_ajax_phanloai').keyup(function() {
                if ($(this).val().length > 0) {
                    $('#close_search').show();
                } else {
                    $('#close_search').hide();
                }
                var content = $('#search_ajax_phanloai').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('phanloai_search') }}",
                    data: {
                        content: content
                    },
                    success: function(data) {
                        $('#phanloai_list_table').html(data);
                    },

                });
            })
            $('#search_ajax_size').keyup(function() {

                if ($(this).val().length > 0) {
                    $('#close_search').show();
                } else {
                    $('#close_search').hide();
                }
                var content = $('#search_ajax_size').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax_size') }}",
                    data: {
                        content: content
                    },
                    success: function(data) {
                        $('#size_list_table').html(data);
                    },

                });
            })
            $('#search_ajax_status').keyup(function() {

                if ($(this).val().length > 0) {
                    $('#close_search').show();
                } else {
                    $('#close_search').hide();
                }
                var content = $('#search_ajax_status').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax_status') }}",
                    data: {
                        content: content
                    },
                    success: function(data) {
                        $('#status_list_table').html(data);
                    },

                });
            })

            $('#search_ajax_color').keyup(function() {

                if ($(this).val().length > 0) {
                    $('#close_search').show();
                } else {
                    $('#close_search').hide();
                }
                var content = $('#search_ajax_color').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax_color') }}",
                    data: {
                        content: content
                    },
                    success: function(data) {
                        $('#color_list_table').html(data);
                    },

                });
            })

            $('#search_ajax_color').keyup(function() {

                if ($(this).val().length > 0) {
                    $('#close_search').show();
                } else {
                    $('#close_search').hide();
                }
                var content = $('#search_ajax_color').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax_color') }}",
                    data: {
                        content: content
                    },
                    success: function(data) {
                        $('#color_list_table').html(data);
                    },

                });
            })

            $('#search_ajax_color').keyup(function() {

                if ($(this).val().length > 0) {
                    $('#close_search').show();
                } else {
                    $('#close_search').hide();
                }
                var content = $('#search_ajax_color').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax_color') }}",
                    data: {
                        content: content
                    },
                    success: function(data) {
                        $('#color_list_table').html(data);
                    },

                });
            })
            $('#search_ajax_brand').keyup(function() {
                if ($(this).val().length > 0) {
                    $('#close_search').show();
                } else {
                    $('#close_search').hide();
                }
                var content = $('#search_ajax_brand').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajax_brand') }}",
                    data: {
                        content: content
                    },
                    success: function(data) {
                        $('#brand_list_table').html(data);
                    },

                });
            })
            $('#search_ajax_theloai').keyup(function() {
                if ($(this).val().length > 0) {
                    $('#close_search').show();
                } else {
                    $('#close_search').hide();
                }
                var content = $('#search_ajax_theloai').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('theloai_search') }}",
                    data: {
                        content: content
                    },
                    success: function(data) {
                        $('#theloai_list_table').html(data);
                    },

                });
            })

       

            $('#close_search').click(function() {
                $('#search_ajax_category').val('');
                $('.search-input').val('');
            })

            $('.file-upload').change(function() {
                let img = $('.img-upload:first');
                let ip_img = $('.file-upload:first');
                if (ip_img[0].files[0]) {
                    img.attr('src', URL.createObjectURL(ip_img[0].files[0]));
                }
            });

        })
    </script>
    <script>
        $(document).ready(function() {
            const $tabs = $(".tab-item");
            const $panes = $(".tab-pane");

            const $tabActive = $(".tab-item.active");
            const $line = $(".tabs .line");

            $line.css({
                left: $tabActive.position().left + "px",
                width: $tabActive.outerWidth() + "px"
            });

            $tabs.on("click", function() {
                $(".tab-item.active").removeClass("active");
                $(".tab-pane.active").removeClass("active");

                $line.css({
                    left: $(this).position().left + "px",
                    width: $(this).outerWidth() + "px"
                });

                $(this).addClass("active");
                $panes.eq($(this).index()).addClass("active");
            });
        });
    </script>

</body>

</html>
