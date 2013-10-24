function load_graphs(num) {
	if (num == 1)
		load_uiskills();
	else if (num == 2)
		load_languages();
	else
		load_strengths();

	return;
	function clear_graphs() {
		
	}
	function load_strengths()
	{
		var width = parseInt($("#strengths").css('width'), 10);
		var height = parseInt($("#strengths").css('height'), 10);
		$("#strengths").attr('width', width);
		$("#strengths").attr('height', height);
		var bar4 = new RGraph.Bar('strengths', [7.5, 9, 8.5, 8.5, 7.5, 8]);
		var gradient = bar4.context.createLinearGradient(0,25,0,225);
		gradient.addColorStop(0, 'red');
		gradient.addColorStop(0.75, 'red');
		gradient.addColorStop(1, '#faa');
		bar4.Set('colors', [gradient]); 
		bar4.Set('labels', ['Algorithms', 'OS', 'Debugging', 'Networking', 'Security', 'Scripting']);
		bar4.Set('chart.tooltips', ['Algorithms', 'OS', 'Debugging', 'Networking', 'Security', 'Scripting']);
		bar4.Set('chart.tooltips.coords.page', true);
		bar4.Set('xlabels.count', 7);
		bar4.Set('ylabels.count', 4);
		bar4.Set('ylabels.width', 4);
		bar4.Set('gutter.top', 50);
		bar4.Set('variant', '3d');
		bar4.Set('strokestyle', 'transparent');
		bar4.Set('scale.round', true);
		bar4.Set('chart.noxaxis', true);
		bar4.Set('chart.noyaxis', true);
		bar4.Set('chart.background.grid', false);
		bar4.Set('chart.text.size', 10);
		bar4.Set('chart.hmargin', 25);
		bar4.Set('chart.text.color', '#eee');
		bar4.Set('chart.ymin', 6);
		bar4.Set('chart.ymax', 10);
		bar4.Set('chart.title', 'Other Strengths');
		bar4.Set('chart.title.size', 15);
		bar4.Set('chart.title.color', '#eee');
		bar4.Set('chart.title.font', 'Titillium Web');
		bar4.Set('chart.barwidth', 5);
		function inner() {
			//bar4.Draw();
			RGraph.Effects.Bar.Grow(bar4);
		}
		function clear() {
			RGraph.Clear(bar4.canvas);
			RGraph.ClearAnnotations(bar4.canvas);
		}
		return inner();
	}
	function load_languages()
	{
		var width = parseInt($("#languages").css('width'), 10);
		var height = parseInt($("#languages").css('height'), 10);
		$("#languages").attr('width', width);
		$("#languages").attr('height', height);
		var data = [30, 30, 20, 10, 5, 5];
		var pie = new RGraph.Pie('languages', data);
		pie.Set('chart.strokestyle', '#555');
		//var colors = ['red','yellow','blue','orange','green','pink']
		//var colors = ['#EC0033','#A0D300','#FFCD00','#00B869','#999999','#FF7300','#004CB0'];
		var colors = ['red', '#FFCD00', '#00B869', '#999999', '#A0D300', '#FF7300'];
		for (var i=0; i<colors.length; ++i) {
			var grad = pie.context.createRadialGradient(125,125, 0, 125,125,125);
			grad.addColorStop(0, 'white');
			grad.addColorStop(0.75, colors[i]);
			grad.addColorStop(1, colors[i]);
			colors[i] = grad;
		}
		pie.Set('chart.colors', colors);
		pie.Set('chart.text.color', '#222');
		pie.Set('chart.text.font', 'Titillium Web');
		pie.Set('chart.text.size', 9);
		pie.Set('chart.linewidth', 2);
		pie.Set('gutter.top', 75);
		pie.Set('chart.shadow', true);
		pie.Set('chart.shadow.offsety', 10);
		pie.Set('chart.shadow.offsetx', 0);
		pie.Set('chart.shadow.color', '#222');
		pie.Set('chart.exploded', 7);
		pie.Set('chart.radius', 90);
		pie.Set('chart.labels', ['C/C++','JavaScript','Php','Perl','Mysql','Shell']);
		pie.Set('chart.tooltips', ['C/C++','JavaScript','Php','Perl','Mysql','Shell']);
		//pie.Set('chart.tooltips.event', 'onmousemove');
		pie.Set('chart.tooltips.coords.page', true);
		pie.Set('chart.title', 'Languages');
		pie.Set('chart.title.size', 11);
		pie.Set('chart.title.color', '#eee');
		pie.Set('chart.title.font', 'Titillium Web');
		pie.Set('chart.labels.sticks', false);
		pie.Set('chart.labels.sticks.length', 40);
		pie.Set('chart.labels.sticks.color', '#222');
		for (i=0; i<data.length; ++i) {
			//pie.Get('chart.labels')[i] = pie.Get('chart.labels')[i] + ', ' + data[i] + '%';
			pie.Set('chart.tooltips')[i] = data[i] + '%';
		}

		// This is the factor that the canvas is scaled by
		var factor = 1.5;
		// Set the transformation of the canvas - a scale up by the factor (which is 1.5 and a simultaneous translate
		// so that the Pie appears in the center of the canvas
		pie.context.setTransform(factor,0,0,1,((pie.canvas.width * factor) - pie.canvas.width) * -0.5,0);

		function inner2() {
			//$("#languages").css('opacity', 1);
			//pie.Draw();
			RGraph.Effects.Pie.RoundRobin(pie, {frames:30});
		}
		//$("#languages").click(inner2);
		return inner2();
	}
	function load_uiskills()
	{
		var width = parseInt($("#uiskills").css('width'), 10);
		var height = parseInt($("#uiskills").css('height'), 10);
		$("#uiskills").attr('width', width);
		$("#uiskills").attr('height', height);
		var data = [6, 7, 7, 7.5, 7.5, 8];
		var bar4 = new RGraph.Bar('uiskills', data);
		//var bar4 = new RGraph.HBar('uiskills', data);
		/*
		var gradient = bar4.context.createLinearGradient(0,25,0,225);
		gradient.addColorStop(0, 'red');
		gradient.addColorStop(0.75, 'red');
		gradient.addColorStop(1, '#faa');
		bar4.Set('colors', [gradient]);
		bar4.Set('colors', ['CAE029', '000']); 
		var colors = ['red', '#FFCD00', '#00B869', '#999999', '#A0D300', '#FF7300'];
		*/
		var colors = ['Gradient(#ccc:blue:blue)', 'Gradient(#ccc:#FFCD00:#FFCD00)', 'Gradient(#ccc:#00B869:#00B869)', 'Gradient(#ccc:brown:brown)', 'Gradient(#ccc:#A0D300:#A0D300)', 'Gradient(#ccc:#FF7300:#FF7300)'];
		bar4.Set('chart.colors', colors);
		bar4.Set('chart.colors.sequential', colors);
		bar4.Set('labels', ['PhotoShop', 'AJAX', 'jQuery', 'JavaScript', 'CSS', 'HTML']);
		bar4.Set('ylabels.count', 6);
		bar4.Set('chart.ylabels.specific', ['Legendary', 'World-class','Professional', 'Semi-pro',   'Amateur']);
		bar4.Set('gutter.top', 40);
		bar4.Set('gutter.left', 80);
		bar4.Set('variant', '3d');
		bar4.Set('strokestyle', 'transparent');
		bar4.Set('scale.round', true);
		bar4.Set('chart.noxaxis', true);
		bar4.Set('chart.noyaxis', true);
		bar4.Set('chart.background.grid', false);
		bar4.Set('chart.text.size', 10);
		bar4.Set('chart.hmargin', 22);
		bar4.Set('chart.text.color', '#eee');
		bar4.Set('chart.ymin', 4);
		bar4.Set('chart.ymax', 10);
		bar4.Set('chart.title', 'FIFA rating of my UI skills');
		bar4.Set('chart.title.size', 13);
		bar4.Set('chart.title.color', '#eee');
		bar4.Set('chart.title.font', 'Titillium Web');
		//bar4.Draw();
		function inner3() {
			//$("#uiskills").css('opacity', 1);
			//bar4.Set('chart.ylabels.specific', bar4.Get('chart.ylabels.specific') ? false : ['High','Medium','Low']); RGraph.Redraw();
			RGraph.Effects.Bar.Grow(bar4);
		}
		//$("#uiskills").click(inner3);
		return inner3();
	}
}

