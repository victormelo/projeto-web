var imgPeca1 = new Image(); imgPeca1.src = "img/tokenShip.png";
var imgPeca2 = new Image(); imgPeca2.src = "img/tokenHat.png";
var imgSpriteDado = new Image(); imgSpriteDado.src = "img/spriteDado.png";

window.requestAnimFrame = (function(){
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          function( callback ){
            window.setTimeout(callback, 1000 / 60);
          };
})();

function sprite (options) {
                
    var that = {},
        frameIndex = 0,
        ticksPerFrame = options.ticksPerFrame || 0,
        numberOfFrames = options.numberOfFrames || 1,
        faces = options.faces || 10;
    
    that.tickCount = 0;
    that.faceCount = 0;
    that.context = options.context;
    that.width = options.width;
    that.height = options.height;
    that.image = options.image;
    that.dado = options.dado;
    that.loop = false;
    that.x = options.x || 0;
    that.y = options.y || 0;

    that.render = function () {
        // Clear the canvas
        that.context.clearRect(that.x, that.y, that.width / numberOfFrames, that.height);

        // Draw the animation
        that.context.drawImage(
            that.image,
            frameIndex * that.width / numberOfFrames,
            that.dado == 2 ? that.height : 0,
            that.width / numberOfFrames,
            that.height,
            that.x,
            that.y,
            that.width / numberOfFrames,
            that.height);
    };
    
    that.update = function () {

        that.tickCount += 1;
        if (that.tickCount > ticksPerFrame && that.faceCount < faces ) {
            that.tickCount = 0;
            var random= Math.floor((Math.random()*6));
            while( (random = Math.floor((Math.random()*6)))  == frameIndex) {};                
            frameIndex = random;
            that.faceCount++;
        } else if(that.faceCount >= faces) {

            that.loop = false;
        }
    };

    that.getResultado = function () {

        return frameIndex+1;
        
    };

    return that;
}

function dados (options) {
                
    var that = {};                    
    that.context = options.context;
    that.x = options.x || 0;
    that.y = options.y || 0;

    that.dado1 = sprite({
            context: that.context,
            width: 408,
            height: 67,
            image: imgSpriteDado,
            numberOfFrames: 6,
            ticksPerFrame: 10,
            x : that.x,
            y : that.y,
            dado: 2
        });
    that.dado2 = sprite({
            context: that.context,
            width: 408,
            height: 67,
            image: imgSpriteDado,
            numberOfFrames: 6,
            ticksPerFrame: 10,
            x : 70 + that.x,
            y: that.y,
            dado: 1
        });
    that.render = function () {
        that.dado1.render();
        that.dado2.render();
    };
    
    that.update = function () {

        that.dado1.update();
        that.dado2.update();
    };

    that.getResultado = function () {

        return (that.dado1.getResultado() + that.dado2.getResultado());
        
    };

    that.isLooping = function() {

        return that.dado1.loop && that.dado2.loop;
    };

    that.play = function() {
        if(!that.isLooping()) {
            that.dado1.tickCount = 0;
            that.dado2.tickCount = 0;
            that.dado1.faceCount = 0;
            that.dado2.faceCount = 0;
            that.dado1.loop = true;
            that.dado2.loop = true;
            game.dadoLoop();
            
        }

    };

    return that;
};

function Square(options) {
    this.type = options.type;
    this.name = options.name;
    this.color = options.color; 
    this.price = options.price; 
    this.img = options.img;
    this.lin = options.lin;
    this.col = options.col;
};

function Jogador(options) {
    var that = {};
    that.casa = options.casa;
    that.image = options.image;
    that.jogador = options.jogador;
    that.context = options.context;
    that.tickCount = 0;
    that.ticksPerFrame = 1;
    that.loop = false;

    var width = game.board.square_width;
    var height = game.board.square_height;
    var extra = that.jogador == 1 ? 30 : 0;
    that.x = 6*width + extra;
    that.y = 6*height + extra;

    that.render = function () {

        
        // Draw the animation

        game.context.drawImage(that.image, that.x, that.y, width/1.9, height/1.9);

    };

    that.update = function (destino, paraFrente) {
        destino = destino % 24;
        var destinoX = game.board.squares[destino].col * game.board.square_width + extra;
        var destinoY = game.board.squares[destino].lin * game.board.square_height + extra;
        that.tickCount += 1;
        // console.log("destinoprox:"+ that.casa);
        // console.log(destinoX);
        if (that.tickCount > that.ticksPerFrame) {
            that.tickCount = 0;

            if(that.x > destinoX) {
                that.x -= 5;
            } else if(that.y > destinoY) {
                that.y -= 5;
            } else if(that.x < destinoX) {
                that.x += 5;
            } else if(that.y < destinoY) {
                that.y += 5;
            }
            if(paraFrente) {
                if( that.x < destinoX && Math.floor( (destino -1) / 6) === 0 || 
                    that.x > destinoX && Math.floor( (destino -1) / 6) === 2 || 
                    that.y < destinoY && Math.floor( (destino -1) / 6) === 1 ||
                    that.y > destinoY && (Math.floor((destino -1) / 6) === 3 || Math.floor((destino -1)/ 6) === -1 ) 
                    ) {
                //if( (that.x  >= destinoX - extra && that.x <= destinoX  )
                 //   &&
                  //  (that.y  >= destinoY - extra && that.y <= destinoY  ))
                // {
                    console.log("entrei " + destino);
                    that.casa = destino;
                    that.x = destinoX;
                    that.y = destinoY;

                }
            } else {
                if( that.x > destinoX && Math.floor( (destino) / 6) === 0 || 
                    that.x < destinoX && Math.floor( (destino) / 6) === 2 || 
                    that.y > destinoY && Math.floor( (destino) / 6) === 1 ||
                    that.y < destinoY && (Math.floor((destino) / 6) === 3 || Math.floor((destino -1)/ 6) === -1 ) 
                    ) {
                //if( (that.x  >= destinoX - extra && that.x <= destinoX  )
                 //   &&
                  //  (that.y  >= destinoY - extra && that.y <= destinoY  ))
                // {
                    console.log("entrei " + destino);
                    that.casa = destino;
                    that.x = destinoX;
                    that.y = destinoY;

                }
            }
        } 
    };

    that.setLoop = function(loop) {
        that.loop = loop;
    }

    return that;
}

var game = {
    
    init: function () {
        

        game.board = getBoard();
        game.canvas = document.getElementById('canvas');
        game.canvasHUD = document.getElementById('canvasHUD');
        game.canvasHUD.addEventListener('mousemove', mouseClicked, false);

        game.canvas.height = 2*game.board.square_height+5*game.board.square_width;
        game.canvas.width = canvas.height;
        game.context = canvas.getContext('2d');
        game.contextHUD = canvasHUD.getContext('2d');


        game.jogador1 = Jogador({
            casa: 0,
            image: imgPeca1,
            jogador : 0,
            context: game.context
        });
        
        game.jogador2 = Jogador({
            casa: 0,
            image : imgPeca2,
            jogador:1,
            context:game.context

        });
        game.drawBoard();
        
        game.dados = dados({
                context: game.contextHUD,
                x : 30,
                y: 500
        });

        game.drawHUD();
    },
    drawBoard: function () {
        game.context.save()
        var extra = Math.abs(game.board.square_height - game.board.square_width)
        for(var i=0; i<24; i++){
            game.context.save()
            //context.rotate(Math.PI);
            var square = game.board.squares[i];
            var square_width = game.board.square_width
            var square_height = game.board.square_height

            if(Math.floor(i/6) == 0){
                var x = game.canvas.width-((i+1)%7)*square_width-extra;
                var y = game.canvas.height-square_height; 
            }
            else if(Math.floor(i/6) == 1){
                game.context.translate(square_height,0)
                game.context.rotate(Math.PI/2)
                //when rotating 90degs, swap x/y
                var y = 0;
                var x = game.canvas.width-(((i+1)%7)+1)*square_width-extra;    
            }

            else if(Math.floor(i/6) == 2){
                game.context.translate(canvas.width-square_width,square_height)
                game.context.rotate(Math.PI)
                var x = game.canvas.width-((i%6)+2)*square_width-extra;
                var y = 0;
            }
            else if(Math.floor(i/6) == 3){
                game.context.translate(game.canvas.height-square_height,game.canvas.width-square_width)
                game.context.rotate(1.5*Math.PI)
                //when rotating 90degs, swap x/y
                var x = game.canvas.width-((i%6)+2)*square_width-extra;
                var y = 0;
            }
            if(square.type=="corner"){
                if(square_height > square_width){
                    square_width += extra;
                } else {
                    square_height += extra;
                }
             
            }
            

            game.context.fillStyle = "#DBF8F0"
            game.context.strokeRect(x, y, square_width, square_height)
            game.context.fillRect(x, y, square_width, square_height)
            game.context.font = 'bold 8pt Arial';

            game.context.fillStyle = 'black';
            game.context.fillText(i, x+2,y+square_height - 15 )

            game.context.fillText(square.name.slice(0,16), x+2,y+square_height - 2 )
            if(square.img) {
                game.context.drawImage(square.img, x+15, y+5, 60, 60);
            } 
            
            if(square.type=="corner"){
                
                game.context.save()
                game.context.translate(x,y)
                game.context.rotate(1.5*Math.PI)
                // game.context.font = '8pt Sans-serif';
                // game.context.fillStyle = 'black';
                game.context.fillText(square.name.slice(0,16), -square_width+6,square_height - 2)

                game.context.restore()
            }
            if(square.type=="property"){
                game.context.save()
                game.context.fillStyle = square.color;
                game.context.fillRect(x, y, square_width, game.board.property_header_height)
                game.context.strokeRect(x, y, square_width, game.board.property_header_height)
                game.context.restore()    
            }

            game.context.restore()
                   
        }
        game.context.restore();
        game.drawJogadores();


    },
    drawJogadores: function() {
        game.jogador1.render();
        game.jogador2.render();

    }, 
    drawHUD: function() {
        game.dados.render();

    
    }, 
    dadoLoop: function() {
        if(game.dados.isLooping()) {

            requestAnimFrame(game.dadoLoop);

            game.dados.render();
            game.dados.update();
            
        } else {
            // salvarJogada(game.dados.getResultado());
            game.jogador1.loop = true;
            // console.log((game.dados.getResultado() + game.jogador1.casa) % 24);
            game.animateJogador(0, (game.dados.getResultado() + game.jogador1.casa) % 24);
            playing = false;
        }    
    },
    animateJogador: function(player, destino, paraFrente) {
        //default é true
        paraFrente = typeof paraFrente !== 'undefined' ? paraFrente : true;
        console.log(paraFrente);

        game.jogador1.loop = !(destino === game.jogador1.casa) && game.jogador1.loop;
        game.jogador2.loop = !(destino === game.jogador2.casa) && game.jogador2.loop;
        var destinoInc = 0;
        // console.log(destino);
        if (game.jogador1.loop || game.jogador2.loop) {
            requestAnimFrame( function() { game.animateJogador(player, destino, paraFrente) } );
            game.drawBoard();
            if(player === 0) {

                if(paraFrente) {
                    destinoInc = game.jogador1.casa + 1;
                } else {
                    var destinoInc = game.jogador1.casa - 1;
                    if(destinoInc === -1) {
                        destinoInc = 23;
                    }
                }

                var destinoProx = Math.abs(destino - game.jogador1.casa) != 0 ? destinoInc : game.jogador1.casa;
                // var destinoProx = Math.abs(destino - game.jogador1.casa) != 0 ? decremento : game.jogador1.casa;
                
                game.jogador1.render();
                game.jogador1.update(destinoProx, paraFrente);
                    
            } else if(player === 1) {
                if(paraFrente) {
                    destinoInc = game.jogador2.casa + 1;
                } else {
                    var destinoInc = game.jogador2.casa - 1;
                    if(destinoInc === -1) {
                        destinoInc = 23;
                    }
                }
                var destinoProx = Math.abs(destino - game.jogador2.casa) != 0 ? destinoInc : game.jogador2.casa;
                
                game.jogador2.render();
                game.jogador2.update(destinoProx, paraFrente);
                    
            }
        }
    }
}

function Button(xL, xR, yT, yB) {
    this.xLeft = xL;
    this.xRight = xR;
    this.yBot = yB;
    this.yTop = yT;


}

Button.prototype.checkClicked = function() {
    if(this.xLeft <= mouseX && mouseX <= this.xRight  &&
        this.yTop <= mouseY && mouseY <= this.yBot) {
        return true;

    } 
}


function mouseClicked(e) {
    mouseX = e.pageX - game.canvasHUD.offsetLeft;

    mouseY = e.pageY - game.canvasHUD.offsetTop;

    // if(btnPlay.checkClicked()) {
        // console.log("clicked");
    // }
} 


// function mouseOver(e) {
//     mouseX = e.pageX - canvasBg.offsetLeft;
//     mouseY = e.pageY - canvasBg.offsetTop;
//     if(btnPlay.checkClicked()) {
//         playGame();
//     }
// }

// function animate(player, casaOrigem, casaDestino) {
//     requestAnimFrame( function(){ animate(player, casaOrigem, casaDestino) } );

//     draw(player, casaOrigem, casaDestino);

// }

// function draw(player, casaOrigem, casaDestino) {
//     var square_width = game.board.square_width;
//     var square_height = game.board.square_height;
//     game.drawBoard();
//     game.context.drawImage(imgPeca1, game.board.squares[casaOrigem].col*square_width+(player*30), game.board.squares[casaOrigem].lin*square_height+(player*20), square_width/1.5, square_height/1.5);
//     contadorMovimento++;  
// }
var playing = false;
function girarDado() {
    if(!playing){
        game.dados.play();
        playing = true;
    }
}