var map, svp;

function Initialize() {
    // �ܓx�E�o�x�ϐ�
    var latlng = new google.maps.LatLng(35.674144, 139.77675999999997);

    //�n�}�̐ݒ�
    var mapOption = {
        heading: 0,
        zoom: 18,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        draggable: false
    };
    //�n�}�I�u�W�F�N�g����
    map = new google.maps.Map(document.getElementById("map"), mapOption);

    //�X�g���[�g�r���[�p�m���}����
    svp = new google.maps.StreetViewPanorama(        
        document.getElementById("svp"), {
            position: map.getCenter(),
            imageDateControl: false
        });
    // �X�g���[�g�r���[�̐ݒ�
    svp.setPov(
        { heading: 0, pitch: 0, zoom: 0 }
        );
    //�n�}�ƃX�g���[�g�r���[�̓���
    map.setStreetView(svp);
    map.bindTo("center", svp, "position");

    //�\�����Ă��錻�݈ʒu
    google.maps.event.addListener(svp, "tilesloaded", review);
    google.maps.event.addListener(svp, "position_changed", review);
}

function review() {
    //document.getElementById("res").innerHTML = svp.getPosition();
}

//�y�[�W�ǂݍ��ݎ���Initialize()�Ăяo��
google.maps.event.addDomListener(window, 'load', Initialize);