jQuery(function ($) {
// load a language
    numeral.language('ina', {
        delimiters: {
            thousands: ',',
            decimal: '.'
        },
        abbreviations: {
            thousand: 'rb',
            million: 'jt',
            billion: 'M',
            trillion: 'T'
        },
        ordinal: function (number) {
            return '.';
        },
        currency: {
            symbol: 'Rp.'
        }
    });

// switch between languages
    numeral.language('ina');

    $('.calx').calx();
});