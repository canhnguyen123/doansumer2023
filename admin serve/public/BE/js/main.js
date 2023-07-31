$(document).ready(function() {
    var itemCount = 1; // Biến đếm ban đầu
    var addedItems = [];
  $('#add-product').click(function(e){
        e.preventDefault()
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
        })
         function isItemAdded(color, size) {
            for (var i = 0; i < addedItems.length; i++) {
                if (addedItems[i].color === color && addedItems[i].size === size) {
                    return true;
                }
            }
            return false;
        }
        $('.res-them').on('click', '.close-item-product', function() {
            var itemColor = $(this).siblings('.item-res-pro').find('.color-item-Pro').text();
            var itemSize = $(this).siblings('.item-res-pro').find('.size-item-Pro').text();

            // Xóa mục hàng khỏi mảng addedItems
            for (var i = 0; i < addedItems.length; i++) {
                if (addedItems[i].color === itemColor && addedItems[i].size === itemSize) {
                    addedItems.splice(i, 1);
                    break;
                }
            }

            $(this).parent().remove();
        });
        
        let totalColor = 0;

        // Lặp qua các phần tử có class "quantity-color-deatil"
        $('.quantyti-item-Pro').each(function() {
            // Lấy giá trị của phần tử hiện tại
            let quantityColorValue = parseInt($(this).text());

            // Kiểm tra xem giá trị có phải là một số hợp lệ hay không trước khi cộng vào tổng
            if (!isNaN(quantityColorValue)) {
                totalColor += quantityColorValue;
            }
        });

        // Hiển thị tổng số màu ra ngoài
        $('.text-quantity').text(totalColor);
        let uniqueSizes = {};
        let uniqueColors = {};

        $('.size-item-Pro').each(function() {
            let size = $(this).text().trim();
            if (!uniqueSizes[size]) {
                uniqueSizes[size] = true;
            }
        });

        $('.size-color-Pro').each(function() {
            let color = $(this).text().trim();
            if (!uniqueColors[color]) {
                uniqueColors[color] = true;
            }
        });

        // Hiển thị tổng số size và màu duy nhất
        $('.text-size').text(Object.keys(uniqueSizes).length);
        $('.text-color').text(Object.keys(uniqueColors).length);
})

    window.addEventListener('DOMContentLoaded', function() {
        var blocks = document.querySelectorAll('.block');
        var maxWidth = 0;

        // Tìm chiều rộng lớn nhất
        blocks.forEach(function(block) {
            var width = block.clientWidth;
            if (width > maxWidth) {
                maxWidth = width;
            }
        });

        // Áp dụng chiều rộng lớn nhất cho tất cả các phần tử
        blocks.forEach(function(block) {
            block.style.width = maxWidth + 'px';
        });
    });
   