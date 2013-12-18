// Code via: http://stackoverflow.com/a/2401861
jQuery(document).ready(function($) {
    $('body').addClass((function(){
        var ua= navigator.userAgent, tem, v,
            s = ['ttt-devices'],
            M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*([\d\.]+)/i) || [];
        
        // if(/trident/i.test(M[1])){
        //     tem=  /\brv[ :]+(\d+(\.\d+)?)/g.exec(ua) || [];
        //     return 'ie '+(tem[1] || '');
        // }
        
        M= M[2]? [M[1], M[2]]:[navigator.appName, navigator.appVersion, '-?'];
        if((tem= ua.match(/version\/([\d]+)\.*/i))!= null) M[2]= tem[1];
        if((v = String(M[1]).match(/(\d+)\.*.*/i)) != null) M[1] = v[1];
        if ( /MSIE/.test( M[0] ) ) M[0] = 'ie';
        if ( /Firefox/.test( M[0] ) || ua.match(/Gecko/i) != null ) M[0] = 'firefox';

        s.push( String(M[0]).toLowerCase() );
        s.push( String(M[0]).toLowerCase()+String(M[1]) );

        if (/Linux/.test( navigator.platform )) s.push('linux');
        else if (/Mac/.test( navigator.platform )) s.push('mac');
        else if (/Win/.test( navigator.platform )) s.push('windows');
        else s.push('unknown-os');

        return s.join(' ');
    })());
});
