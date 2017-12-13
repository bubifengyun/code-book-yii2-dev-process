// QRCODE reader Copyright 2011 Lazar Laszlo
// http://www.webqr.com

var gCtx = null;
var gCanvas = null;
var c=0;
var stype=0;
var gUM=false;
var webkit=false;
var moz=false;
var v=null;
var result='result';
var callback=null;
var width=800;
var height=600;

function setoptions(options){
    width=options.width;
    height=options.height;
    callback=options.callback;
}


var imghtml='<div id="qrfile" class="qrfile"><canvas id="out-canvas" width="320" height="240"></canvas>'+
    '<div id="imghelp" class="imghelp">拖拽或者选择'+
	'<br>一张二维码图片'+
	'<input type="file" onchange="handleFiles(this.files)"/>'+
	'</div>'+
'</div>';

var vidhtml = '<video id="v" class="v" autoplay></video>';

function dragenter(e) {
  e.stopPropagation();
  e.preventDefault();
}

function dragover(e) {
  e.stopPropagation();
  e.preventDefault();
}
function drop(e) {
  e.stopPropagation();
  e.preventDefault();

  var dt = e.dataTransfer;
  var files = dt.files;
  if(files.length>0)
  {
	handleFiles(files);
  }
  else
  if(dt.getData('URL'))
  {
	qrcode.decode(dt.getData('URL'));
  }
}

function handleFiles(f)
{
	var o=[];
	
	for(var i =0;i<f.length;i++)
	{
        var reader = new FileReader();
        reader.onload = (function(theFile) {
        return function(e) {
            gCtx.clearRect(0, 0, gCanvas.width, gCanvas.height);

			qrcode.decode(e.target.result);
        };
        })(f[i]);
        reader.readAsDataURL(f[i]);	
    }
}

function initCanvas(w,h)
{
    gCanvas = document.getElementById("qr-canvas");
    gCanvas.style.width = w + "px";
    gCanvas.style.height = h + "px";
    gCanvas.width = w;
    gCanvas.height = h;
    gCtx = gCanvas.getContext("2d");
    gCtx.clearRect(0, 0, w, h);
}


function captureToCanvas() {
    if(stype!=1)
        return;
    if(gUM)
    {
        try{
            gCtx.drawImage(v,0,0);
            try{
                qrcode.decode();
            }
            catch(e){       
                console.log(e);
                setTimeout(captureToCanvas, 500);
            };
        }
        catch(e){       
                console.log(e);
                setTimeout(captureToCanvas, 500);
        };
    }
}

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function read(a)
{
    var html="<br>";
    if(a.indexOf("http://") === 0 || a.indexOf("https://") === 0)
        html+="<a target='_blank' href='"+a+"'>"+a+"</a><br>";
    html+="<b>"+htmlEntities(a)+"</b><br><br>";
    document.getElementById(result).innerHTML=html;
    $.ajax({
        type: 'POST',
        url: callback,
        dataType: 'json',
        data: {qrresult: a},
        success: function(data) {
            if (data.status === 'error') {
                alert('系统错误，无法操作。');
            } else if(data.status === 'none') {
                alert('没有识别出来');
            } else if(data.status === 'warning') {
                alert('代码非法，不可使用。');
            } else {
                alert(data.status);
            }
        },
    });
}	

function isCanvasSupported(){
  var elem = document.createElement('canvas');
  return !!(elem.getContext && elem.getContext('2d'));
}
function success(stream) {
    v.src = window.URL.createObjectURL(stream);
    gUM=true;
    setTimeout(captureToCanvas, 500);
}
		
function error(error) {
    gUM=false;
    return;
}

function load()
{
	if(isCanvasSupported() && window.File && window.FileReader)
	{
		initCanvas(width, height);
		qrcode.callback = read;
		document.getElementById("mainbody").style.display="inline";
        setwebcam();
	}
	else
	{
		document.getElementById("mainbody").style.display="inline";
		document.getElementById("mainbody").innerHTML='<p id="mp1" class="mp1">二维码识别需要支持HTML5的浏览器</p><br>'+
        '<br><p id="mp2">抱歉，您的浏览器不支持。</p><br><br>'+
        '<p id="mp1" class="mp1">请安装最新版火狐或者谷歌浏览器</p>';
	}
}

function setwebcam()
{
	document.getElementById(result).innerHTML="- 扫描中 -";
    if(stype==1)
    {
        setTimeout(captureToCanvas, 500);    
        return;
    }
    var n=navigator;
    document.getElementById("outdiv").innerHTML = vidhtml;
    v=document.getElementById("v");

    if(n.getUserMedia)
        n.getUserMedia({video: true, audio: false}, success, error);
    else
    if(n.mediaDevices.getUserMedia)
        n.mediaDevices.getUserMedia({video: { facingMode: "environment"} , audio: false})
            .then(success)
            .catch(error);
    else
    if(n.webkitGetUserMedia)
    {
        webkit=true;
        n.webkitGetUserMedia({video:true, audio: false}, success, error);
    }
    else
    if(n.mozGetUserMedia)
    {
        moz=true;
        n.mozGetUserMedia({video: true, audio: false}, success, error);
    }

    //document.getElementById("qrimg").src="qrimg2.png";
    //document.getElementById("webcamimg").src="webcam.png";
    document.getElementById("qrimg").style.opacity=0.2;
    document.getElementById("webcamimg").style.opacity=1.0;

    stype=1;
    setTimeout(captureToCanvas, 500);
}
function setimg()
{
	document.getElementById(result).innerHTML="";
    if(stype==2)
        return;
    document.getElementById("outdiv").innerHTML = imghtml;
    //document.getElementById("qrimg").src="qrimg.png";
    //document.getElementById("webcamimg").src="webcam2.png";
    document.getElementById("qrimg").style.opacity=1.0;
    document.getElementById("webcamimg").style.opacity=0.2;
    var qrfile = document.getElementById("qrfile");
    qrfile.addEventListener("dragenter", dragenter, false);  
    qrfile.addEventListener("dragover", dragover, false);  
    qrfile.addEventListener("drop", drop, false);
    stype=2;
}
