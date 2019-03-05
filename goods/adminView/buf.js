function save(str,num) {
    var a=md5(str);
    for(var i=0;i<a.length;i+=num){
        buf[(parseInt(a.substr(i,num)),16)]=1;
    }
}
function diff(str,num,same,no) {
    var a=md5(str);
    for(var i =0;i<a.length;a+=num){
        buf[(parseInt(a.substr(i,num),16))]=1;

    }
}