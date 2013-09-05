var imgChanceAzul = new Image(); imgChanceAzul.src = "img/chanceAzul.png";
var imgChanceRosa = new Image(); imgChanceRosa.src = "img/chanceRosa.png";
var imgChanceVermelho = new Image(); imgChanceVermelho.src = "img/chanceVermelho.png";
var imgEletrica = new Image(); imgEletrica.src = "img/light.png";
var imgSaneamento = new Image(); imgSaneamento.src = "img/waterCompany.png";
var imgTransp = new Image(); imgTransp.src = "img/trains.png";
var imgPhone = new Image(); imgPhone.src = "img/phone.png";
var imgThumb = new Image(); imgThumb.src = "img/thumbsUp.png";
var imgSuper = new Image(); imgSuper.src = "img/superImp.png";
var imgTax = new Image(); imgTax.src = "img/tax.png";
var imgStart = new Image(); imgStart.src = "img/start.png";
var imgJail = new Image(); imgJail.src = "img/gotoJail.png";
var imgEstac = new Image(); imgEstac.src = "img/estacionamento.png";
var imgVisita = new Image(); imgVisita.src = "img/jail.png";

function getBoard() {
    return {
        square_width: 92,
        square_height: 92,
        property_header_height: 20,
        squares: [
            new Square({type:"corner", name:"Ponto de Início", color: "#eee", price:200, img:imgStart, lin:6, col:6}),
            new Square({type:"property", name:"Leblon", color: "purple", price: 100 , lin:6, col:5}),
            new Square({type:"chest", name:"Sorte-Azar", color: "yellow", img : imgChanceAzul, lin:6, col:4}),
            new Square({type:"property", name:"Morumbi", color: "purple" , lin:6, col:3}),
            new Square({type:"company", name:"Co. Saneamento", color: "lime", img : imgSaneamento , lin:6, col:2}),
            new Square({type:"property", name:"Copacabana", color: "purple" , lin:6, col:1}),
            
            new Square({type:"corner", name:"Visita à Prisão", color: "#eee", img:imgVisita , lin:6, col:0}),
            new Square({type:"property", name:"Av. Europa", color: "magenta" , lin:5, col:0}),
            new Square({type:"company", name:"Co. Elétrica", color: "lime", img : imgEletrica , lin:4, col:0}),
            new Square({type:"property", name:"Rua Augusta", color: "magenta" , lin:3, col:0}),
            new Square({type:"chest", name:"Sorte-Azar", color: "yellow", img : imgChanceRosa , lin:2, col:0}),
            new Square({type:"tax", name:"Super Imposto", color: "brown", img:imgSuper , lin:1, col:0}),
            
            new Square({type:"corner", name:"Parada Livre", color: "#eee", img:imgEstac , lin:0, col:0}),
            new Square({type:"property", name:"Av. Paulista", color: "red" , lin:0, col:1}),
            new Square({type:"tax", name:"Imposto de R.", color: "brown", img:imgTax , lin:0, col:2}),
            new Square({type:"property", name:"Av. Brasil", color: "red" , lin:0, col:3}),
            new Square({type:"company", name:"Co. de Telecom", color: "lime", img : imgPhone , lin:0, col:4}),
            new Square({type:"property", name:"Interlagos", color: "red" , lin:0, col:5}),
            
            new Square({type:"corner", name:"Você foi preso", color: "#eee", img:imgJail , lin:0, col:6}),
            new Square({type:"property", name:"Ipanema", color: "green" , lin:1, col:6}),
            new Square({type:"chest", name:"Sorte-Azar", color: "yellow", img : imgChanceVermelho , lin:2, col:6}),
            new Square({type:"company", name:"Co. de Transp", color: "lime", img : imgTransp , lin:3, col:6}),
            new Square({type:"property", name:"Av. Atlântica", color: "green" , lin:4, col:6}),
            new Square({type:"tax", name:"Imposto Legal", color: "brown", img:imgThumb , lin:5, col:6}),

        ]
    };
};