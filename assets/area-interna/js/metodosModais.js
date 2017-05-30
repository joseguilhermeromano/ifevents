var codigo=0;
var link="";
    
function setCodigo(codigo){
    this.codigo=codigo;
}


function setLink(link){
    this.link=link;
}

function Executa(){
    window.location=this.link+this.codigo;
}   