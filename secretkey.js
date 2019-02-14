function dec2hex(s) { return (s < 15.5 ? '0' : '') + Math.round(s).toString(16); }
function hex2dec(s) { return parseInt(s, 16); }

function base32tohex(base32) {
  var base32chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
  var bits = "";
  var hex = "";

  for (var i = 0; i < base32.length; i++) {
    var val = base32chars.indexOf(base32.charAt(i).toUpperCase());
    bits += leftpad(val.toString(2), 5, '0');
  }

  for (var i = 0; i + 4 <= bits.length; i += 4) {
    var chunk = bits.substr(i, 4);
    hex = hex + parseInt(chunk, 2).toString(16);
  }
  return hex;

}

function leftpad(str, len, pad) {
  if (len + 1 >= str.length) {
    str = Array(len + 1 - str.length).join(pad) + str;
  }
  return str;
}

function updateOtp() {

  var key = base32tohex($('#secret').val());
  var epoch = Math.round(new Date().getTime() / 1000.0);
  var time = leftpad(dec2hex(Math.floor(epoch / 30)), 16, '0');

  //JS SHA 라이브러리 사용
  var shaObj = new jsSHA("SHA-1", "HEX");
  shaObj.setHMACKey(key, "HEX");
  shaObj.update(time);
  var hmac = shaObj.getHMAC("HEX");
  $('#secret').val(Conversions.base32.encode(leftpad($('#userID').val(),'1','!')));////////
  $('#qrImg').attr('src', 'https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=200x200&chld=M|0&cht=qr&chl=otpauth://totp/클라이언트(생성)%3Fsecret%3D' + $('#secret').val());
  $('#secretHex').text(key);
  $('#secretHexLength').text((key.length * 4) + ' bits');
  $('#epoch').text(time);
  $('#hmac').empty();

  if (hmac == 'KEY MUST BE IN BYTE INCREMENTS') {
    $('#hmac').append($('<span/>').addClass('label important').append(hmac));
  } else {
    var offset = hex2dec(hmac.substring(hmac.length - 1));
    var part1 = hmac.substr(0, offset * 2);
    var part2 = hmac.substr(offset * 2, 8);
    var part3 = hmac.substr(offset * 2 + 8, hmac.length - offset);
    if (part1.length > 0) $('#hmac').append($('<input/>').addClass('label label-default').append(part1));
    $('#hmac').append($('<input/>').addClass('label label-primary').append(part2));
    if (part3.length > 0) $('#hmac').append($('<input/>').addClass('label label-default').append(part3));
  }

  otp = (hex2dec(hmac.substr(offset * 2, 8)) & hex2dec('7fffffff')) + '';
  otp = (otp).substr(otp.length - 6, 6);
  $('#otp').text(otp);
  $('#otp').val(otp);
  //console.log(otp)
}

// function test(){
//       var uotpval = $('#otptext').val();
//       $("#send").click(function(uotpval){
//       chk(uotpval);
//       alert(uotpval);
//       });
// }
//
// function chk(uotp){
//
//   $.ajax({
//     type : 'post',
//     url : '/otpauth.php',
//     data : 'otp=' + otp + '&userotp=' + uotp,//wait save go
//     success : function(data){
//       alert('ok');
// //      console.log(json);
//       //console.log(data);
//       //console.log($('#otp').text(otptest));
//       //console.log($('#otp').text(otp))
//     },
//     error: function(data) {
//     alert('err' + data.status);
//  }
//   });
// }

function timer() {
  var epoch = Math.round(new Date().getTime() / 1000.0);
  var countDown = 30 - (epoch % 30);
  if (epoch % 30 == 0){
    updateOtp();
    //console.log($('#otp').text());
    //var otptest = $('#otp').text();
    //console.log(otptest);

    //console.log($('#otp').text(otp));
    //console.log(countDown);

  }
  $('#updatingIn').text(countDown);
    setInterval(timer, 1000);
}

$(function () {
  updateOtp();

  // $('#update').click(function (event) {
  //   updateOtp();
  //   event.preventDefault();
  // });
  //
  // $('#secret').keyup(function () {
  //   updateOtp();
  // });
  // //입력한 값 가져오기
  //
  // $('#userID').keyup(function () {
  //   //console.log(leftpad($('#userID').val(),'1','!'));
  //   $('#secret').val(Conversions.base32.encode(leftpad($('#userID').val(),'1','!')));
  //   updateOtp();
  // });

  setInterval(timer, 1000);
});

// Note that we assume ascii strings, not unicode.
// A better implementation should use array buffers
// of bytes, and force a conversion before executing,
// and convert outputs back into strings.
(function(exports) {
    var base32 = {
        a: "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567",
        pad: "",
        encode: function (s) {
            var a = this.a;
            var pad = this.pad;
            var len = s.length;
            var o = "";
            var w, c, r=0, sh=0;
            for(i=0; i<len; i+=5) {
                // mask top 5 bits
                c = s.charCodeAt(i);
                w = 0xf8 & c;
                o += a.charAt(w>>3);
                r = 0x07 & c;
                sh = 2;

                if ((i+1)<len) {
                    c = s.charCodeAt(i+1);
                    // mask top 2 bits
                    w = 0xc0 & c;
                    o += a.charAt((r<<2) + (w>>6));
                    o += a.charAt( (0x3e & c) >> 1 );
                    r = c & 0x01;
                    sh = 4;
                }

                if ((i+2)<len) {
                    c = s.charCodeAt(i+2);
                    // mask top 4 bits
                    w = 0xf0 & c;
                    o += a.charAt((r<<4) + (w>>4));
                    r = 0x0f & c;
                    sh = 1;
                }

                if ((i+3)<len) {
                    c = s.charCodeAt(i+3);
                    // mask top 1 bit
                    w = 0x80 & c;
                    o += a.charAt((r<<1) + (w>>7));
                    o += a.charAt((0x7c & c) >> 2);
                    r = 0x03 & c;
                    sh = 3;
                }

                if ((i+4)<len) {
                    c = s.charCodeAt(i+4);
                    // mask top 3 bits
                    w = 0xe0 & c;
                    o += a.charAt((r<<3) + (w>>5));
                    o += a.charAt(0x1f & c);
                    r = 0;
                    sh = 0;
                }
            }
            // Calculate length of pad by getting the
            // number of words to reach an 8th octet.
            if (r!=0) { o += a.charAt(r<<sh); }
            var padlen = 8 - (o.length % 8);
            // modulus
            if (padlen==8) { return o; }
            if (padlen==1) { return o + pad; }
            if (padlen==3) { return o + pad + pad + pad; }
            if (padlen==4) { return o + pad + pad + pad + pad; }
            if (padlen==6) { return o + pad + pad + pad + pad + pad + pad; }
            console.log('there was some kind of error');
            console.log('padlen:'+padlen+' ,r:'+r+' ,sh:'+sh+', w:'+w);
        },
        decode: function(s) {
            var len = s.length;
            var apad = this.a + this.pad;
            var v,x,r=0,bits=0,c,o='';

            s = s.toUpperCase();

            for(i=0;i<len;i+=1) {
                v = apad.indexOf(s.charAt(i));
                if (v>=0 && v<32) {
                    x = (x << 5) | v;
                    bits += 5;
                    if (bits >= 8) {
                        c = (x >> (bits - 8)) & 0xff;
                        o = o + String.fromCharCode(c);
                        bits -= 8;
                    }
                }
            }
            // remaining bits are < 8
            if (bits>0) {
                c = ((x << (8 - bits)) & 0xff) >> (8 - bits);
                // Don't append a null terminator.
                // See the comment at the top about why this sucks.
                if (c!==0) {
                    o = o + String.fromCharCode(c);
                }
            }
            return o;
        }
    };

    var base32hex = {
        a: '0123456789ABCDEFGHIJKLMNOPQRSTUV',
        pad: '=',
        encode: base32.encode,
        decode: base32.decode
    };
    exports.base32 = base32;
    exports.base32hex = base32hex;
})(this.Conversions = {});
