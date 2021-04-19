$(document).ready(function () {

    $('#filter_brand').change(function () { ajax_sorting(); });

    $('#filter_category').change(function () { ajax_sorting(); });

    $('#filter_price').change(function () { ajax_sorting(); });

    $('#filter_price').inde

    function sort_tents(data) {
        var sort_price = $("#filter_price").val();
        var sort_category = $("#filter_category").val();
        var sort_brand = $('#filter_brand').val();

        console.log('\n\n До сортировки');
        console.log(data);
        // сортировка по категории
        if (sort_category.length > 0) {
            console.log(sort_category);
            data = data.filter(a => sort_category.indexOf(String(a.PK_Category)) != -1);
        }

        // сортировка по бренду
        if (sort_brand.length > 0) {
            //console.log('!!');
            data = data.filter(a => sort_brand.indexOf(String(a.PK_Brand)) != -1);
        }

        // сортировка по цене - возрастание/убывание
        if (sort_price === "ascending_price") {
            data.sort((a, b) => a.price - b.price);
        }
        else if (sort_price === "descending_price") {
            data.sort((a, b) => b.price - a.price);
        }

       console.log('\n\n После сортировки');
       console.log(data);

        return data;
    }

    function ajax_sorting() {
        $.ajax({
            type: "GET",
            url: window.location.href, 
            success: function (tents_data) {
                tents_data = sort_tents(tents_data);
                $("#container-tents").html('');

                if (tents_data.length > 0) {
                    $.each(tents_data, function (index) {
                        var imagepath = tents_data[index].imagepath;
                        if (imagepath === "empty.png" || imagepath === "") imagepath = '/static/img/empty.png';


                        $("#container-tents").append(
                            '<div class="col-lg-3 col-md-6 my-2">' +
                            '<div class="card single-item h-100">' +
                            '<a href="' + tents_data[index].get_url + '">' +
                            '<img src="' + imagepath + '" class="card-img-top" alt="' + tents_data[index].name + '">' +
                            '<div class="card-body">' +
                            '<h5>Палатка ' + tents_data[index].name + '</h5>' +
                            '<h6>Бренд:' + tents_data[index].brand + '</h6>' +
                            '<h6>Категория:' + tents_data[index].category + '</h6>' +
                            '<p>Цена:' + tents_data[index].price + 'руб.</p>' +
                            '<p>Кол-во мест:' + tents_data[index].places + '</p>' +
                            '<p>Вес:' + tents_data[index].weight + 'кг</p>' +
                            '<p>Кол-во входов:' + tents_data[index].doors + '</p>' +
                            '<p>Кол-во окон:' + tents_data[index].windows + '</p>' +
                            '</div>' +
                            '</a>' +
                            '</div>' +
                            '</div>'
                        );
                    });
                }
                else {
                    $("#container-tents").append(
                        '<h3>Ничего не найдено</h3>'
                    );
                }
            },
            error: function (msg) {
                alert(msg.responseJSON.message)
            },
        });
    }
});









