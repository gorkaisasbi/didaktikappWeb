$(document).ready(()=>{
    $speechActivo = false;
    const Speech = window.SpeechRecognition || window.webkitSpeechRecognition;
    const talk = new SpeechSynthesisUtterance();
    if(Speech != undefined || talk != undefined){
        console.log("Navegador es compatible con speechRecognition");
        $speechActivo = true;

        talk.volume = 1;
        talk.rate = 1;
        talk.pitch = 1;

        recog = new Speech();

        recog.onstart = ()=>{
            console.log("start speech");
            abrirNavegacion();
        };

        recog.onresult = (e)=>{
            cerrarNavegacion();
            var txt = e.results[e.resultIndex][0].transcript;

            if(txt.toLowerCase() =="ir a perfil"){
                abrirPerfil();
                talk.text = "Abriendo perfil";
                window.speechSynthesis.speak(talk);
            }
        };

        

    }else{
        console.log("Navegador no es compatible con speechRecognition");
    }



    
});