import $ from 'jquery';

class Search {
	// 1. describe and create/initiate our object
	constructor(){
		this.addSearchHTML();
		this.resultsDiv = $("#search-overlay__results")
		this.openButton	= $(".js-search-trigger"); 
		this.closeButton = $(".search-overlay__close"); // selecciono el icono X por la clase
		this.searchOverlay = $(".search-overlay");
		this.searchField = $("#search-term");
		this.events();
		this.isOverlayOpen = false;
		this.isSpinnerVisible = false;
		this.previousValue;
		this.typingTimer;
	}

	// 2. events
	events(){
		this.openButton.on('click', this.openOverlay.bind(this));
		this.closeButton.on('click', this.closeOverlay.bind(this));
		$(document).on("keydown", this.keyPressDispatcher.bind(this));
		this.searchField.on("keyup", this.typingLogic.bind(this));
	}



	// 3. methods (function, action..)
	typingLogic(){
		if(this.searchField.val() != this.previousValue){
			clearTimeout(this.typingTimer); // reseteamos el tiempo de ejecucion para que se ejecute 
			//una sola vez luego de 2 segundos

			if(this.searchField.val()){

				if(!this.isSpinnerVisible){
					this.resultsDiv.html('<div class="spinner-loader"></div>');
					this.isSpinnerVisible = true;
				}
			
				this.typingTimer = setTimeout(this.getResults.bind(this) ,750);

			} else {
				this.resultsDiv.html('');
				this.isSpinnerVisible = false;
			}
		}

		this.previousValue = this.searchField.val();
	}

	getResults(){

		$.getJSON(universityData.root_url + '/wp-json/university/v1/search?term='+this.searchField.val(), (results) => {
			this.resultsDiv.html(`
					<div class="row">
						<div class="one-third">
							<h2 class="search-overlay__section-title">General Information</h2>
							${ results.generalInfo.length ? '<ul class="link-list min-list">'	: '<p>No general information matches</p>'}
								${results.generalInfo.map(item => `<li> <a href="${item.permalink}">${item.title}</a> ${ item.postType=='post' ? `by ${item.authorName}` : ''}</li>`).join('')}
								// loop del array de resultados
							${ results.generalInfo.length ? '</ul>' : ''}
						</div>
						<div class="one-third">
							<h2 class="search-overlay__section-title">Programns</h2>
							${ results.programs.length ? '<ul class="link-list min-list">'	: `<p>No programs match that search.<a href="${universityData.root_url}/programs" View all programs</a></p>`}
								${results.programs.map(item => `<li> <a href="${item.permalink}">${item.title}</a> </li>`).join('')}
								// loop del array de resultados
							${ results.programs.length ? '</ul>' : ''}
							<h2 class="search-overlay__section-title">Professors</h2>
						</div>
						<div class="one-third">
							<h2 class="search-overlay__section-title">Campuses</h2>
							${ results.campuses.length ? '<ul class="link-list min-list">'	: `<p>No campuses match that search <a href="${universityData.root_url}/campuses" View all campuses</a></p>`}
								${results.campuses.map(item => `<li> <a href="${item.permalink}">${item.title}</a> </li>`).join('')}
								// loop del array de resultados
							${ results.campuses.length ? '</ul>' : ''}
							<h2 class="search-overlay__section-title">Events</h2>
						</div>
					</div>
				`);
		});
		this.isSpinnerVisible = false;
		
	}


	keyPressDispatcher(e){

		if (e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(':focus')) {// al presionar S
											// Y no hace foco en ningun imput o textarea		
			this.openOverlay();
			this.isOverlayOpen = true;
			
		}

		if (e.keyCode == 27 && this.isOverlayOpen) { // al presionar ESC
			this.closeOverlay();
			this.isOverlayOpen = false;

		}
	}

	openOverlay(){
		this.searchOverlay.addClass("search-overlay--active");
		$("body").addClass("body-no-scroll");
		this.searchField.val('');
		this.resultsDiv.html('');
		setTimeout( () => this.searchField.focus() ,301); 
		// es lo mismo que setTimeout( function () { this.searchField.focus(); } ,301);  
		this.isOverlayOpen = true;

	}

	closeOverlay(){
		this.searchOverlay.removeClass("search-overlay--active");
		$("body").removeClass("body-no-scroll");
		
		this.isOverlayOpen = false;

	}

	addSearchHTML(){
		$("body").append(`
			<!-- DIV DE BUSQUEDA -->
    <div class="search-overlay">
      <div class="search-overlay__top">
        <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input autocomplete="off" id="search-term" type="text" class="search-term" placeholder="What are you looking for????">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
        </div>
      </div>

      <div class="container">
        <div id="search-overlay__results"> </div>
      </div>
    </div>
			`);
	}

}

// esto nos permite importar la clase en el archivo que querramos, en nuestro caso en index.js
//export default Search 
