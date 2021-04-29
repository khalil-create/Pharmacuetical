
// edit_main_area.blade.php data by ajax
function editForm() {

    save_method='add';
    $('input[name_method]').val('POST');

    /* $('#model-form form')[0].reset();*/

    $('.modal-title').text("Edit SubArea");
    $('#insertbutton').text('Update Sub');
    $('#modal-form').modal("show");


}
function deleteuser( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/delete/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم حذف المشرف بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "acount";});},
                error:function (data) {swal({
					title: "نجاح",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذا المستخدم',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
function deleterep( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/deleter/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم الحذف المندوب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "acount";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذا المستخدم',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}

function admin() {
    swal(
        {
            title:'تم رفض الحذف ',
            text: 'لا يمكن حذف بيانات مدير نظام',
            icon:'warning',
            confirm:'إنهاء'
        }
    )

}
function deleteigroup(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/deleteigroup/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم حذف مجموعة الصنف بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "item_groups";});},
                error:function (data) {swal({
					title: "نجاح",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المجموعة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deleteitem(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/deleteitem/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم حذف الصنف بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "add_items";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذا الصنف',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deletemarea(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/deletemarea/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم حذف المنطقة الرئيسية بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "main_area";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deletesubarea(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/deletesubarea/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم حذف المنطقة الفرعية بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "sub_rea";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
$(document).ready(function() {
    $('#state').on('change', function() {
        var stateID = $(this).val();
        if(stateID) {
            $.ajax({
                url: '/findCityWithStateID/'+stateID,
                type: "GET",
                data : {"_token":"{{ csrf_token() }}"},
                dataType: "json",
                success:function(data) {
                    //console.log(data);
                    if(data){
                        $('.bs-checkbox').empty();
                        $('.bs-checkbox').focus;
                        /* $('#city').append('<option selected disabled hidden>إختيار </option>');*/

                        $.each(data, function(key, value){
                            $('.bs-checkbox').append('<label class="col-md-12" ><input class="minimal" type="checkbox" name="city[]" value="'+value.id+'" > ' + value.sub_area_name+ '</lable>');
                        });
                        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                            checkboxClass: 'icheckbox_minimal-blue',
                            radioClass   : 'iradio_minimal-blue',
                        });
                    }else{
                        $('.bs-checkbox').empty();
                    }
                }
            });
        }else{
            $('.bs-checkbox').empty();
        }
    });
});


$(document).ready(function() {
        $('#rep_no').on('change', function() {
                var stateID = $(this).val();
                if(stateID) {
                    $.ajax({
                        url: '/find_item/'+stateID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data) {
                            //console.log(data);
                            if(data){
                                $('.bs-checkbox').empty();
                                $('.bs-checkbox').focus;
                                /* $('#city').append('<option selected disabled hidden>إختيار </option>');*/

                                $.each(data.sup_item, function(key, value){
                                    $.each(data.allitem, function(keys, valued){
                                        if (value.id === valued.id)
                                        {
                                            $('.bs-checkbox').append('<label class="col-sm-12" ><input class="minimal" type="checkbox" name="city[]" value="'+valued.id+'" > ' + valued.item_name+ '</lable>');
                                        }
                                        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                            checkboxClass: 'icheckbox_minimal-blue',
                                            radioClass   : 'iradio_minimal-blue',
                                        });

                                    });

                                });
                            }}});
                }

                else{
                    $('.bs-checkbox').empty();
                }
            }
        );
    }
);
$(document).ready(function() {
        $('#task_no').on('change', function() {
                var stateID = $(this).val();
                if(stateID) {
                    $.ajax({
                        url: '/find_rep/'+stateID,
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data) {
                            //console.log(data);
                            if(data){
                                $('.bs-checkbox').empty();
                                $('.bs-checkbox').focus;
                                /* $('#city').append('<option selected disabled hidden>إختيار </option>');*/

                                $.each(data.sup_task, function(key, value){
                                    $.each(data.allrep, function(keys, valued){
                                        if (value.id === valued.id)
                                        {
                                            $('.bs-checkbox').append('<label class="col-sm-12" ><input class="minimal" type="checkbox" name="city[]" value="'+valued.id+'" > ' + valued.full_name+ '</lable>');
                                        }
                                        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                            checkboxClass: 'icheckbox_minimal-blue',
                                            radioClass   : 'iradio_minimal-blue',
                                        });

                                    });

                                });
                            }}});
                }

                else{
                    $('.bs-checkbox').empty();
                }
            }
        );
    }
);

function deletereparea(id,sup_id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/deletemarea",
                type:'get',
                data:{'id':id,'sup_id':sup_id},
                success:function(response ) {
                    sweetAlert({
						 title: "نجاح",
                        text:'تم ازالة المنطقة للمندوب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "rep_area_manage";});},
                error:function (data) {swal({
					title: "نجاح",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة ',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}

$(document).ready(function() {
        $('#date_of_plan').on('change', function() {
                var stateID = 1;
                if(stateID) {
                    $.ajax({
                        url: '/findCust',
                        type: "GET",
                        data : {"_token":"{{ csrf_token() }}"},
                        dataType: "json",
                        success:function(data) {
                            //console.log(data);
                            if(data){
                                $('.bs-checkbox').empty();
                                $('.bs-checkbox').focus;
                                /* $('#city').append('<option selected disabled hidden>إختيار </option>');*/

                                $.each(data.cus_txt, function(key, value){
                                    $.each(data.rep_cus, function(keys, valued){
                                        if (value.id === valued.cus_id)
                                        {
                                            $('.bs-checkbox').append('<label class="col-sm-12" ><input class="minimal" type="checkbox" checked="true" name="cus_no_txt[]" value="'+value.id+'" > ' + value.customer_name+ '</lable>');
                                        }
                                        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                                            checkboxClass: 'icheckbox_minimal-blue',
                                            radioClass   : 'iradio_minimal-blue',
                                        });

                                    });

                                });
                            }}});
                }

                else{
                    $('.bs-checkbox').empty();
                }
            }
        );
    }
);
function delete_sup_item(sup_id,id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,

    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/deleteSupItem",
                type:'get',
                data:{'sup_no':sup_id,'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم  الحذف بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "mange_item";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذا الصنف',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deleteSupArea(sup_id,area_id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,

    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/deletesuparea",
                type:'get',
                data:{'sup_no':sup_id,'area_no':area_id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم  الحذف بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage_area";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذا المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deletereptask(id,sup_id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,

    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/deletereptask",
                type:'get',
                data:{'id':id,'sup_id':sup_id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم حذف المهمة للمندوب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "tasks";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذا المهمة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function takeroll(sup_id,roll_id,state) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد سحب الصلاحيات؟",
        text: "ايقاف  صلاحيات المشرف ",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/roll_take",
                type:'get',
                data:{'sup':sup_id,'roll':roll_id,'state':state},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم سحب الصلاحيات بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "permission";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم اخذ الصلاحيات ',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function activeroll(sup_id,roll_id,state) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريدإعطاء الصلاحيات؟",
        text: "ايقاف  صلاحيات المشرف ",
        icon: "info",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/roll_active",
                type:'get',
                data:{'sup':sup_id,'roll':roll_id,'state':state},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تنشيط الصلاحيات بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "permission";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم تنشيط الصلاحيات ',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
// active and stop acount
function active( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد تنشيط الحساب؟",
        text: "تنشيط حساب مستخدم!",
        icon: "info",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/active/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم تنشيط الحساب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "acount";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم تنشيط حساب المستخدم؟',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
function active_rep( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد تنشيط الحساب؟",
        text: "تنشيط حساب مستخدم!",
        icon: "info",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/active/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم تنشيط الحساب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "users";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم تنشيط حساب المستخدم',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
function stop( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد إيقاف الحساب؟",
        text: "إيقاف حساب مستخدم!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/stop/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم ايقاف الحساب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "acount";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم إيقاف حساب المستخدم',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
function stop_rep( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد إيقاف الحساب؟",
        text: "إيقاف حساب مستخدم!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/acount/stop/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم ايقاف الحساب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "users";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم ايقاف الحساب',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
// active and stop main area
function active_main( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد تنشيط المنطقة؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "info",
        buttons: true,
        confirmButtonText:'تنشيط',
        cancelButtonText:'إلفاء',
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/main_area/active/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم تنشيط المنطقة الرئيسية بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "main_area";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم تنشيط المنطقة الرئيسية',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}

function active_sup_area(sup_id,area_id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
         title: "هل تريد تنشيط المنطقة؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "info",
        buttons: true,
        confirmButtonText:'تنشيط',
        cancelButtonText:'إلفاء',
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/sup_area/active",
                type:'get',
                data:{'sup_no':sup_id,'area_no':area_id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم تنشيط المنطقة للمشرف بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage_area";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم تنشيط المنطقة للمشرف.',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}

function stop_main( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد إيقاف المنطقة؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "warning",
        buttons: true,

        dangerMode: true,

        confirm:'تنشيط',
        cancel:'إلفاء',
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/main_area/stop/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم وقف المنطقة الرئيسية بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "main_area";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم إيقاف المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}

function stop_sup_area(sup_id,area_id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد إيقاف المنطقة؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "warning",
        buttons: true,

        dangerMode: true,

        confirm:'تنشيط',
        cancel:'إلفاء',

    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/sup_area/stop",
                type:'get',
                data:{'sup_no':sup_id,'area_no':area_id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم ايقاف المنطقة للمشرف المحدد بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage_area";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم وقف المنطقة الفرعية',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
// active and stop sub area
function active_sub( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد تنشيط المنطقة؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "info",
        buttons: true,
        confirmButtonText:'تنشيط',
        cancelButtonText:'إلفاء',
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/sub_area/active/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم تنشيط المنطقة الفرعية بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "sub_rea";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم تنشيط المنطقة الفرعية',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
function active_order( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد تنشيط المنطقة؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "info",
        buttons: true,
        confirmButtonText:'تنشيط',
        cancelButtonText:'إلفاء',
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/order/active/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم تأكيد الطلبية بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "orders";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم تأكيد الطلبية',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
function stop_order( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد تنشيط المنطقة؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "info",
        buttons: true,
        confirmButtonText:'تنشيط',
        cancelButtonText:'إلفاء',
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/order/stop/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم الغاء الطلبية بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "orders";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم الغاء الطلبية',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}

function stop_sub( id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد إيقاف المنطقة؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "warning",
        buttons: true,

        dangerMode: true,

        confirm:'تنشيط',
        cancel:'إلفاء',
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/sub_area/stop/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم ايقاف العمل بالمنطقة بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "sub_rea";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم إيقاف المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
function active_rep_sub_area(id,sub_id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد تنشيط المنطقة؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "info",
        buttons: true,
        confirmButtonText:'تنشيط',
        cancelButtonText:'إلفاء',
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/rep_sub_area/active",
                type:'get',
                 data:{'rep_no':id,'sub_no':sub_id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم تنشيط المنطقة للمندوب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "rep_area_manage";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم تنشيط المنطقة للمندوب',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
function stop_rep_sub_area(id,sub_id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد إيقاف المنطقة القرغية للمندوب؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "warning",
        buttons: true,

        dangerMode: true,

        confirm:'تنشيط',
        cancel:'إلفاء',
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/rep_sub_area/stop",
                type:'get',
                data:{'rep_no':id,'sub_no':sub_id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم ايقاف المنطقة للمندوب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "rep_area_manage";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم إيقاف المنطقة للمندوب',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}

function delete_studies(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/studies/delete/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم حذف الدراسة العلمية بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "studies";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم حذف الدراسة العلمية',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}

function delete_tasks(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/tasks/delete/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم حذف المهمة بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "tasks";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم حذف المهمة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function active_item(supid,itemid) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
         title: "هل تريد تفعيل الصنف؟",
        text: "إيقاف العمل في  المنطقة!",
        icon: "info",
        buttons: true,
        confirmButtonText:'تفعيل',
        cancelButtonText:'إلفاء',
        dangerMode: true,

    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/manage/active",
                type:'get',
                data:{'sup_no':supid,'id':itemid},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم تفعيل الصنف للمشرف المحدد بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "mange_item";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم تفعيل الصنف المحدد للمشرف',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function stop_item(supid,itemid) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
         title: "هل تريد إيقاف  الصنف؟",
        text: "إيقاف  الصنف  !",
        icon: "info",
        buttons: true,
        confirmButtonText:'ايقاف',
        cancelButtonText:'إلفاء',
        dangerMode: true,

    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/manage/stop",
                type:'get',
                data:{'sup_no':supid,'id':itemid},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم ايقاف الصنف للمشرف المحدد بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "mange_item";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم ايقاف الصنف',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function active_rep_item(id,item_id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد تفعيل الصنف؟",
        text: "تفعيل الصنف!",
        icon: "info",
        buttons: true,
        confirmButtonText:'تفعيل',
        cancelButtonText:'إلفاء',
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/rep_manage_item/active",
                type:'get',
                data:{'rep_no':id,'item_no':item_id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم تفعيل الصنف للمندوب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "rep_item_manage";});},
                error:function (data) {swal({
					title: "توقف",
                    text:' لم يتم تفعيل الصنف للمندوب',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
function stop_rep_item(id,item_id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد ايقاف الصنف؟",
        text: "ايقاف الصنف!",
        icon: "info",
        buttons: true,
        confirmButtonText:'ايقاف',
        cancelButtonText:'إلفاء',
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/rep_manage_item/stop",
                type:'get',
                data:{'rep_no':id,'item_no':item_id},
                success:function(response ) {
                    sweetAlert({
						title: "نجاح",
                        text:'تم الغاء تفعيل الصنف للمندوب بنجاح',
                        icon: "success",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "rep_item_manage";});},
                error:function (data) {swal({
					title: "توقف",
                    text:'لم يتم الغاء الصنف للمندوب',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});}
					
function deletPlan_type(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/mange/deletPlan_type/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
                        text:'تم حذف نوع الخطة بنجاح',
                        icon: "info",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage";});},
                error:function (data) {swal({
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function delet_Day(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/mange/delet_Day/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
                        text:'تم حذف نوع اليوم بنجاح',
                        icon: "info",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage";});},
                error:function (data) {swal({
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deletSpeshal(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/mange/deletSpeshal/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
                        text:'تم حذف نوع التخصص بنجاح',
                        icon: "info",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage";});},
                error:function (data) {swal({
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deletBess(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/mange/deletBess/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
                        text:'تم حذف نوع العمل بنجاح',
                        icon: "info",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage";});},
                error:function (data) {swal({
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deletSgement(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/mange/deletSgement/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
                        text:'تم حذف نوع التصنيف بنجاح',
                        icon: "info",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage";});},
                error:function (data) {swal({
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deletServicestype(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/mange/deletServicestype/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
                        text:'تم حذف نوع الخدمة بنجاح',
                        icon: "info",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage";});},
                error:function (data) {swal({
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
function deletVisType(id) {
    var csrf_token=$('meta[name="csrf-token"]').attr('content');
    swal({
        title: "هل تريد الحذف؟",
        text: "سيتم فقد جميع البيانات عند تأكيد الحذف!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete)
        {$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $.ajax({
                url:"/mange/deletVisType/"+id,
                type:'get',
                data:{'id':id},
                success:function(response ) {
                    sweetAlert({
                        text:'تم حذف نوع الزيارة بنجاح',
                        icon: "info",
                        confirm:"إنهاء",}).then((result) => {window.location.href = "manage";});},
                error:function (data) {swal({
                    text:'لم يتم الحذف لوجود بيانات مرتبطة بهذه المنطقة',
                    icon: "info",
                    confirm: 'إنهاء',});}});} else {}});
}
