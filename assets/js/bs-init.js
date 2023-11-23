document.addEventListener('DOMContentLoaded', function() {

	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bss-tooltip]'));
	var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	  return new bootstrap.Tooltip(tooltipTriggerEl);
	})

	var charts = document.querySelectorAll('[data-bss-chart]');

	for (var chart of charts) {
		chart.chart = new Chart(chart, JSON.parse(chart.dataset.bssChart));
	}
}, false);