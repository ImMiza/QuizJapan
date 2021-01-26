<footer class="page-footer font-small">
	<div class="container-fluid bg-dark text-center text-white p-3">
   		<div class="row">
      		<div class="col">
         		<a href="">A propos</a>
         		<a href="">Vie privée</a>
         		<a href="">Condition d'utilisation</a>
      		</div>
   		</div>
   		<div class="row">
   			<div class="col">
   				<i class="far fa-copyright"></i> 2021 QuizJapan, tout droit réservé.
   			</div>
   		</div>
	</div>

</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script defer>
	$( function() {
		$.widget( "custom.catcomplete", $.ui.autocomplete, {
		_create: function() {
			this._super();
			this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
		},
		_renderMenu: function( ul, items ) {
			var that = this,
			currentCategory = "";
			$.each( items, function( index, item ) {
			var li;
			if ( item.category != currentCategory ) {
				ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
				currentCategory = item.category;
			}
			li = that._renderItemData( ul, item );
			if ( item.category ) {
				li.attr( "aria-label", item.category + " : " + item.label );
			}
			});
		}
		});
	
		$( "#navbar_search_button" ).catcomplete({
		delay: 0,
		source: '../src/Completion/CardPackageSearch.php'
		});
 	 } );
</script>