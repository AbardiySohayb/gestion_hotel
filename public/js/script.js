let double_price = 80;
let economy_price = 50;
let suite_price=150;
var details = [];

var $cart = $('#selected-seats'),
    $counter = $('#counter'),
    $total = $('#total');

let rows = 10;
let cols = 6;
let totalSeats = rows * cols;

var sc = $('#seat-map').seatCharts({
    map: [
        'aebeae',
        'aeebeb',
        'eaeabe',
        'eaeaee',
        'aaebbe',
        'beaebe',
        'eeeaae',
        'eaaebe',
        'eaebbe',
        'aaeebe',
    ],
    seats: {
        e: {
            price: economy_price,
            classes: 'single',
            category: 'single'
        },
        a: {
            price: suite_price,
            classes: 'suite',
            category: 'suite'
        },
        b: {
            price: double_price,
            classes: 'double',
            category: 'double'
        }
    },
    naming: {
        top: false,
        getLabel: function(character, row, column) {
            return totalSeats - (row * cols + column - 7);
        },
    },
    click: function() {
        if (this.status() == 'available') {
            var seatId = this.settings.id;
            if (isSeatBlocked(seatId)) {
                return 'unavailable';
            }

            $(event.target).toggleClass('animated rubberBand');
            $('<li class="p-b-4">' + this.data().category + ' Seat # ' +
                this.settings.label + ': <b>$ ' + this.data().price +
                '</b> <a href="javascript:void(0);"' +
                ' class="cancel-cart-item btn btn-danger btn-sm"><i class="fa fa-trash"></i> Annuler</a></li>')
                .attr('id', 'cart-item-' + this.settings.id)
                .data('seatId', this.settings.id)
                .appendTo($cart);

            $counter.text(sc.find('selected').length + 1);
            $total.text(recalculateTotal(sc) + this.data().price);
            details.push({
                ['seatNo']: this.settings.label,
                ['price']: this.data().price
            });

            updatePaymentInfo();

            return 'selected';
        } else if (this.status() == 'selected') {
            $(event.target).toggleClass('animated rubberBand');
            $counter.text(sc.find('selected').length - 1);
            $total.text(recalculateTotal(sc) - this.data().price);

            $('#cart-item-' + this.settings.id).remove();
            details = details.filter(function(item) {
                return item.seatNo != this.settings.label;
            }.bind(this));

            updatePaymentInfo();

            return 'available';
        } else if (this.status() == 'unavailable') {
            return 'unavailable';
        } else {
            return this.style();
        }
    }
});

let recalculateTotal = sc => {
    var total = 0;

    sc.find('selected').each(function() {
        total += this.data().price;
    });

    return total;
}

function updatePaymentInfo() {
    let roomDetailsHTML = '';
    let total = 0;

    details.forEach(detail => {
        roomDetailsHTML += `<p>chambre N° ${detail.seatNo}: <b>Ksh ${detail.price}</b></p>`;
        total += detail.price;
    });

    $('.room-details').html(roomDetailsHTML);
    $('#total-price').text(total);
    $('#total-amount').val(total);
    $('#reservation-details').val(details.map(d => `Siège N° ${d.seatNo}: $ ${d.price}`).join(', '));
}

$('#selected-seats').on('click', '.cancel-cart-item', function() {
    $('#' + sc.get($(this).parents('li:first').data('seatId')).settings.id)
        .toggleClass('animated rubberBand');
    sc.get($(this).parents('li:first').data('seatId')).click();
});

function isSeatBlocked(seatId) {
    return blockedSeats.includes(seatId);
}

function booked_seats() {
    sc.find('unavailable').status('available');
    blockedSeats.forEach((seat) => {
        sc.get(seat).status('unavailable');
    });
}

$(document).ready(function() {
    booked_seats();
});
