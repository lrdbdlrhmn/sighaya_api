$(function(){
    $('#user_state_id').change(function (e){
        var items = ['<option value="">اختر المدينة</option>'];
        $('#user_city_id').html(items.join(''));
        $('#user_region_id').html('<option value="">اختر المنطقة</option>');
        $.getJSON( "/admin/cities?state_id=" + $(this).val(), function( data ) {
            $.each( data, function( key, val ) {
              items.push( "<option value='" + val.id + "'>" + val.name + "</option>" );
            });
            $('#user_city_id').html(items.join(''))
        });
    });
    $('#user_city_id').change(function (e){
        var items = ['<option value="">اختر المنطقة</option>'];
        $('#user_region_id').html(items.join(''));
        $.getJSON( "/admin/regions?state_id=" + $('#user_state_id').val() + "&city_id=" + $(this).val(), function( data ) {
            $.each( data, function( key, val ) {
              items.push( "<option value='" + val.id + "'>" + val.name + "</option>" );
            });
            $('#user_region_id').html(items.join(''))
        });
    });
    $('#user_user_type, #user_region_id').change(function (e){
        var user_type = $('#user_user_type').val();
        var region_id = $("#user_region_id").val();
        var items = ['<option value="">اختر المدير</option>'];
        $('#user_manager_id').html(items.join(''))
        if(user_type == 'technical' && region_id){
            $('#user_manager_id').parent().removeClass('d-none');
            $.getJSON( "/admin/users?region_id=" + region_id + "&user_type=manager", function( data ) {
                $.each( data, function( key, val ) {
                  items.push( "<option value='" + val.id + "'>" + val.first_name + ' ' + val.last_name + "</option>" );
                });
                $('#user_manager_id').html(items.join(''))
            });
        }else{
            $('#user_manager_id').parent().addClass('d-none');
        }
    });


    // regions
    $('#region_state_id').change(function (e){
        var items = ['<option value="">اختر المدينة</option>'];
        $('#region_city_id').html(items.join(''));
        $('#region_region_id').html('<option value="">اختير المنطقة</option>');
        $.getJSON( "/admin/cities.json?state_id=" + $(this).val(), function( data ) {
            $.each( data, function( key, val ) {
              items.push( "<option value='" + val.id + "'>" + val.name + "</option>" );
            });
            $('#region_city_id').html(items.join(''))
        });
    });

    // report
    $('#report_manager_id').change(function (e){
        var items = ['<option value="">اختر التقني</option>'];
        $('#report_technical_id').html(items.join(''));
        $('#region_region_id').html('<option value="">اختر التقني</option>');
        $.getJSON( "/admin/cities.json?state_id=" + $(this).val(), function( data ) {
            $.each( data, function( key, val ) {
              items.push( "<option value='" + val.id + "'>" + val.name + "</option>" );
            });
            $('#region_city_id').html(items.join(''))
        });
    });

    // filters
    $('#filter_report_type').change(function(){
        // consoe
        window.location.href = '?report_type=' + $(this).val()
    });
    $('select[data-filter]').change(function(){
        // consoe
        window.location.href = '?' + $(this).attr('id') + '=' + $(this).val()
    });
});