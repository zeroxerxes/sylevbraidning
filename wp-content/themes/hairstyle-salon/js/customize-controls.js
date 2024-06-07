( function( api ) {

	// Extends our custom "hairstyle-salon" section.
	api.sectionConstructor['hairstyle-salon'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );