$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2010 Q1',
            cash: 2666,
            outgoing: null,
            incoming: 2647
        }, {
            period: '2010 Q2',
            cash: 2778,
            outgoing: 2294,
            incoming: 2441
        }, {
            period: '2010 Q3',
            cash: 4912,
            outgoing: 1969,
            incoming: 2501
        }, {
            period: '2010 Q4',
            cash: 3767,
            outgoing: 3597,
            incoming: 5689
        }, {
            period: '2011 Q1',
            cash: 6810,
            outgoing: 1914,
            incoming: 2293
        }, {
            period: '2011 Q2',
            cash: 5670,
            outgoing: 4293,
            incoming: 1881
        }, {
            period: '2011 Q3',
            cash: 4820,
            outgoing: 3795,
            incoming: 1588
        }, {
            period: '2011 Q4',
            cash: 15073,
            outgoing: 5967,
            incoming: 5175
        }, {
            period: '2012 Q1',
            cash: 10687,
            outgoing: 4460,
            incoming: 2028
        }, {
            period: '2012 Q2',
            cash: 8432,
            outgoing: 5713,
            incoming: 1791
        }],
        xkey: 'period',
        ykeys: ['cash', 'outgoing', 'incoming'],
        labels: ['Cash', 'Outgoing', 'Incoming'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    // Morris.Bar({
    //     element: 'morris-bar-chart',
    //     data: [{
    //         y: '2006',
    //         a: 100,
    //         b: 90
    //     }, {
    //         y: '2007',
    //         a: 75,
    //         b: 65
    //     }, {
    //         y: '2008',
    //         a: 50,
    //         b: 40
    //     }, {
    //         y: '2009',
    //         a: 75,
    //         b: 65
    //     }, {
    //         y: '2010',
    //         a: 50,
    //         b: 40
    //     }, {
    //         y: '2011',
    //         a: 75,
    //         b: 65
    //     }, {
    //         y: '2012',
    //         a: 100,
    //         b: 90
    //     }],
    //     xkey: 'y',
    //     ykeys: ['a', 'b'],
    //     labels: ['Series A', 'Series B'],
    //     hideHover: 'auto',
    //     resize: true
    // });

});
