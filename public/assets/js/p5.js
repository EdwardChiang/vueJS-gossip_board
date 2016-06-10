var clearBtn;
var rSlider, gSlider, bSlider;
var cnv;
var userDrawImg = document.getElementsByClassName('drawImgDiv')[0];
//var userDrawImg = $('drawImg');
//var userDrawImg = document.getElementById('m');
var userReply = $('.userReply');
function setup() {
    rSlider = createSlider(0, 255, 0);
    //rSlider.parent("myContainer");
    rSlider.parent(userDrawImg);
    //rSlider.position(150, 520);

    gSlider = createSlider(0, 255, 0);
    //gSlider.parent("myContainer");
    gSlider.parent(userDrawImg);
    //gSlider.position(150, 550);

    bSlider = createSlider(0, 255, 0);
    //bSlider.parent("myContainer");
    bSlider.parent(userDrawImg);
    //bSlider.position(150, 580);

    cnv = createCanvas(userReply.width(), 500);
    cnv.parent(userDrawImg);
    cnv.id('userReplyImgCanvas');
    textSize(15);
    noStroke();
    background(255);

    clearBtn = createButton('clear').addClass('btn');
    //button.parent("myContainer");
    clearBtn.parent(userDrawImg);
    //button.position(10, 550);
    clearBtn.mousePressed(changeBG);
    frameRate(80);
}
function draw() {
    var r = rSlider.value();
    var g = gSlider.value();
    var b = bSlider.value();
    if (mouseIsPressed) {
        fill(r,g,b);
        ellipse(mouseX, mouseY, 20, 20);
    }
}
function changeBG() {
    background(255);
}
/*$(function () {
    $("#bGenImage").click(function () {
        var $canvas = $("#input");
        $("#dOutput").html(
            $("<img />", { src: $canvas[0].toDataURL(),
                "class": "output"
            })
        );
    });
});*/