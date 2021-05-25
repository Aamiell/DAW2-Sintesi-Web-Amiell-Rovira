class PhotoCanvas {
    constructor(divid) {
        this.parentDiv = divid; // ID del DIV que contindrà la nostra aplicació
        this.ctx;
        this.mousePos;
        this.output;
        this.gruixlinea;
        this.guardarcoords;
        this.finalcoords;
        this.primerclick = 1;
        this.forma = "linea";

        /* Aquest funció li diu al navegador que la funció actionButton, quan treballi amb el this
        no serà el this de l'objecte que l'ha cridada (el this que crida és el botó), 
        sinó el this actual (el this actual fa referència a l'objecte de la classe) */
        this.crearcanvas = this.crearcanvas.bind(this);
        this.actualitzarCoords = this.actualitzarCoords.bind(this);
        this.marcarCoords = this.marcarCoords.bind(this);
        this.limpiarCoords = this.limpiarCoords.bind(this);
        this.oMousePos = this.oMousePos.bind(this);
        this.ClickRatoli = this.ClickRatoli.bind(this);
        this.FormaLinea = this.FormaLinea.bind(this);
        this.FormaCercle = this.FormaCercle.bind(this);
        this.borrardibuix = this.borrardibuix.bind(this);

        // creeem el canvas y els tres botons y el dos inputs
        this.canvas = document.createElement("canvas");
        this.canvas.width = "525";
        this.canvas.height = "300";
        this.canvas.style = "border:1px solid #000000";
        this.canvas.style.backgroundColor = "#386E53";
        this.canvas.id = "divcanvas";
        this.canvas.addEventListener("mousemove", this.crearcanvas);
        this.canvas.addEventListener("click", this.ClickRatoli);
        let br = document.createElement("br");

        let btlinea = document.createElement("button");
        btlinea.type = "button";
        //btlinea.class = "btn btn-outline-info";
        let btcercle = document.createElement("button");
        btcercle.type = "button";
        let btpcercle = document.createElement("button");
        btpcercle.type = "button";
        let btborrar = document.createElement("button");
        btborrar.type = "button";
        let selgruix = document.createElement("input");
        selgruix.type = "number";
        selgruix.id = "numgruix";
        selgruix.min = "0";
        selgruix.max = "10";
        selgruix.value = "1";
        let selcolor = document.createElement("input");
        selcolor.type = "color";
        selcolor.id = "selcolor";

        let container = document.getElementById(divid); // objecte HTML on inserir la nostra aplicació

        //Creem un node de tipus text per inserir el text dins del botó LINEA I CERCLE
        container.appendChild(this.canvas);

        let node1 = document.createTextNode("LINEA");
        btlinea.appendChild(node1);
        let node2 = document.createTextNode("CERCLE");
        btcercle.appendChild(node2);
        let node4 = document.createTextNode("CERCLE PINTAT");
        btpcercle.appendChild(node4);
        let node3 = document.createTextNode("BORRAR");
        btborrar.appendChild(node3);


        // associem l'esdeveniment click a les funcios de FormaLinea, FormaCercle
        btlinea.addEventListener("click", this.FormaLinea);
        btcercle.addEventListener("click", this.FormaCercle);
        btpcercle.addEventListener("click", this.FormaPintarCercle);
        btborrar.addEventListener("click", this.borrardibuix);

        container.appendChild(br); // afegim el salt de linea  a la jerarquia d'objectes
        container.appendChild(btlinea); // afegim el botó a la jerarquia d'objectes
        container.appendChild(btcercle); // afegim el botó a la jerarquia d'objectes
        container.appendChild(btpcercle); // afegim el botó a la jerarquia d'objectes
        container.appendChild(selgruix); // afegim el botó a la jerarquia d'objectes
        container.appendChild(selcolor); // afegim el botó a la jerarquia d'objectes
        container.appendChild(btborrar); // afegim el botó a la jerarquia d'objectes
    }

    crearcanvas() {
        if (this.canvas && this.canvas.getContext) {
            this.ctx = this.canvas.getContext("2d");
            if (this.ctx) {
                //Creem un rectangle blanc per ficar les coordenades
                this.ctx.fillStyle = "#fff";
                this.ctx.fillRect(1, 1, 180, 50);
                //Si entrem amb el ratoli ens envia a actualitzarCoords 
                this.canvas.addEventListener("mousemove", this.actualitzarCoords);
                //Si surtim amb el ratoli ens envia a llimpiarCoords
                this.canvas.addEventListener("mouseout", this.limpiarCoords);
            }
        }
    }

    actualitzarCoords() {
        //Una vegada entrem a actulitzarCoords ens envia a marcaCoords
        this.mousePos = this.oMousePos(window.event);
        this.marcarCoords(this.mousePos.x, this.mousePos.y)
    }

    marcarCoords(x, y) {
        // Creem un caudre blanc
        this.ctx.beginPath();
        //Definim el color de la lletra
        this.ctx.fillStyle = "#fff";
        this.ctx.fillRect(1, 1, 180, 50);
        //Creem el text de color negre y el tipus de lletra per ficar les coordenades
        this.ctx.fillStyle = "red";
        this.ctx.font = "15px Arial";
        //Les coordenades
        this.ctx.fillText("Coords: " + "x: " + x + ", y: " + y, 20, 30);
        //Tanquem el pintar
        this.ctx.closePath();
    }

    limpiarCoords() {
        this.output.innerHTML = "";
        this.output.style.top = 0 + "px";
        this.output.style.left = 0 + "px";
        this.output.style.backgroundColor = "transparent"
        this.output.style.border = "none";
        this.canvas.style.cursor = "default";
    }

    oMousePos(evt) {
        var ClientRect = this.canvas.getBoundingClientRect();
        return { //objeto
            x: Math.round(evt.clientX - ClientRect.left),
            y: Math.round(evt.clientY - ClientRect.top)
        }
    }

    FormaLinea() {
        //Si le hem donat al boto de linea la variable forma te el valor linea
        this.forma = "linea";
    }

    FormaCercle() {
        //Si le hem donat al boto de cercle la variable forma te el valor cercle
        this.forma = "cercle";
    }

    FormaPintarCercle() {
        //Si le hem donat al boto de linea la variable forma te el valor linea
        this.forma = "pintarcercle";
    }

    dibuixar() {
        //Si hem donat click a linea
        if (this.forma == "linea") {
            //Establim el gruix amb la variable creada
            this.ctx.lineWidth = document.getElementById("numgruix").value;
            //Establim el color amb la variable creada
            this.ctx.strokeStyle = document.getElementById("selcolor").value;
            //Començem a pintar
            this.ctx.beginPath();
            //Li diem les coordenades pero sense dibuixar
            this.ctx.moveTo(this.guardarcoords.x, this.guardarcoords.y);
            //Li diem desde on hem començat hasta on hem arribat
            this.ctx.lineTo(this.finalcoords.x, this.finalcoords.y);
            //Pintem
            this.ctx.stroke();
            //Tanquem el pintar
            this.ctx.closePath();
            //Si hem donat click a cercle
        } else if (this.forma == "cercle") {
            this.ctx.beginPath();
            //Establim el gruix amb la variable creada
            this.ctx.lineWidth = document.getElementById("numgruix").value;
            //Establim el color amb la variable creada
            this.ctx.strokeStyle = document.getElementById("selcolor").value;
            let r = Math.sqrt((this.guardarcoords.x - this.finalcoords.x) * (this.guardarcoords.x - this.finalcoords.x) + (this.guardarcoords.y - this.finalcoords.y) * (this.guardarcoords.y - this.finalcoords.y));
            this.ctx.arc(this.guardarcoords.x, this.guardarcoords.y, r, 0, 2 * Math.PI);
            //Pintem
            this.ctx.stroke();
            //Tanquem el pintar
            this.ctx.closePath();
        } else if (this.forma == "pintarcercle") {
            this.ctx.beginPath();
            //Establim el gruix amb la variable creada
            this.ctx.lineWidth = document.getElementById("numgruix").value;
            //Establim el color amb la variable creada
            this.ctx.strokeStyle = document.getElementById("selcolor").value;
            //this.ctx.fillStyle = document.getElementById("selcolor").value;
            let r = Math.sqrt((this.guardarcoords.x - this.finalcoords.x) * (this.guardarcoords.x - this.finalcoords.x) + (this.guardarcoords.y - this.finalcoords.y) * (this.guardarcoords.y - this.finalcoords.y));
            this.ctx.arc(this.guardarcoords.x, this.guardarcoords.y, r, 0, 2 * Math.PI);
            //Pintem
            this.ctx.stroke();
            //Tanquem el pintar
            this.ctx.closePath();
        }
    }

    ClickRatoli() {
        //si hem donat un sol click
        if (this.primerclick == 1) {
            this.primerclick++;
            //Guardem les coordenades al fer el primerclick
            this.guardarcoords = this.oMousePos(window.event);
        } else {
            //Si hem fet el segonclick
            this.primerclick = 1;
            //Guardem les coordenades al fer el segonclick
            this.finalcoords = this.oMousePos(window.event);
            this.dibuixar();
        }
    }

    borrardibuix() {
        //Li diem l'amplada y l'altura que volem borrar
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height)
    }
}