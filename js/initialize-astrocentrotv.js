	var $ = jQuery.noConflict();


	//Init dropdown filters
	var dropdownFilter = {

		$filters: null,
		$reset: null,
		groups: [],
		outputArray: [],
		outputString: '',

		init: function(){
			var self = this;

			self.$filters = $('#Filters');
			self.$reset = $('#Reset');
			self.$container = $('#grid-videos');

			self.$filters.find('fieldset').each(function(){
				self.groups.push({
					$dropdown: $(this).find('select'),
					active: ''
				});
			});

			self.bindHandlers();
		},

		bindHandlers: function(){
			var self = this;

			self.$filters.on('change', 'select', function(e){
				e.preventDefault();

				self.parseFilters();
			});
		},

		parseFilters: function(){
			var self = this;

			for(var i = 0, group; group = self.groups[i]; i++){
				group.active = group.$dropdown.val();
			}

			self.concatenate();
		},

		concatenate: function(){
			var self = this;

			self.outputString = '';

			for(var i = 0, group; group = self.groups[i]; i++){
				self.outputString += group.active;
			}

			!self.outputString.length && (self.outputString = 'all');

			if(self.$container.mixItUp('isLoaded')){
				self.$container.mixItUp('filter', self.outputString);
			}
		}
	};

//On load
	$(function(){
		$('#grid-videos').mixItUp({
			animation: { enable: false }
		});

		$('#grid-videos').mixItUp('sort', 'sort:desc');

		$('#grid-videos').mixItUp({
			targetDisplayGrid: 'inline-block',
			targetDisplayList: 'block'
		});

		dropdownFilter.init();

		$('#grid-videos').mixItUp({
			controls: {
				enable: false
			},
			callbacks: {
				onMixFail: function(){
					alert('Nenhum item encontrado!');
				}
			}
		});


//popUp video
	$('.open-popup-link').magnificPopup({
		type:'inline',
		midClick: true,
		mainClass: 'custom-popup-class'
	});


	});
