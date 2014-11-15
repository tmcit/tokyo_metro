/**
 * http://plusblog.jp/3719/
 * @param {type} elm
 * @param {type} tl
 * @param {type} mes
 * @returns {CountdownTimer}
 */

function CountdownTimer(elm,tl,mes){
    this.initialize.apply(this,arguments);
}
CountdownTimer.prototype={
    initialize:function(elm,tl,mes) {
        this.elem = document.getElementById(elm);
        this.tl = tl;
        this.mes = mes;
    },countDown:function(){
        var timer='';
        var today=new Date();
        var day=Math.floor((this.tl-today)/(24*60*60*1000));
        var hour=Math.floor(((this.tl-today)%(24*60*60*1000))/(60*60*1000));
        var min=Math.floor(((this.tl-today)%(24*60*60*1000))/(60*1000))%60;
        var sec=Math.floor(((this.tl-today)%(24*60*60*1000))/1000)%60%60;
        var milli=Math.floor(((this.tl-today)%(24*60*60*1000))/10)%100;
        var me=this;

        if( ( this.tl - today ) > 0 ){
            if (day) timer += '<span class="day">'+day+'日</span>';
            if (hour) timer += '<span class="hour">'+hour+'時間</span>';
            timer += '<span class="min">'+this.addZero(min)+'分</span><span class="sec">'+this.addZero(sec)+'秒</span><span class="milli">'+this.addZero(milli)+'</span>';
            this.elem.innerHTML = timer;
            tid = setTimeout( function(){me.countDown();},10 );
        }else{
            finish();
            this.elem.innerHTML = this.mes;
            return;
        }
    },addZero:function(num){ return ('0'+num).slice(-2); }
};