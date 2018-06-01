function showDonut(data){
	var pie = d3.pie().sort(null).value(function(d , i ) {	return d; });

	var path = d3.arc()
					.outerRadius(radius)
					.innerRadius(40);
	var arc = donut.selectAll(".arc")
								.data( pie([  data[0] , 0  ]) ).enter().append("g")
														.attr("class", "arc");
	arc.append("path")
			.attr("d", path)
			.attr("fill", function(d , i ) { return prop.colorBack; });

}

function legendDefault(data){
	textg = donut.select(".arc").append("g") 
									.attr("class", "textCaprion");
	textg.append("text")
		  .attr("transform", function(d) {  return "translate( 0 , "+ (radius+50) + ")"; })
		  .attr("text-anchor"  , "middle" )
		  .attr("dy", "0.35em")
		  .attr("font-family" , "Proxima Nova")
		  .attr("font-size" , "14")
		  .text("План"  );


	textg.append("text")
	  .attr("transform", function(d) {  return "translate( 0 , "+ (radius+70) + ")"; })
	  .attr("text-anchor"  , "middle" )
	  .attr("dy", "0.35em")
	  .attr("font-family" , "Proxima Nova")
	  .attr("font-size" , "18")
	  .attr("fill", prop.legendValue)
	  .text(currencySwapDef ( data[0])  );

	textg.append("text")
	  .attr("transform", function(d) {  return "translate( 0 , "+ (radius+90) + ")"; })
	  .attr("text-anchor"  , "middle" )
	  .attr("dy", "0.35em")
	  .attr("font-family" , "sans-serif")
	  .attr("font-size" , "14")
	  .text("Факт"  );

	textg.append("text")
	  .attr("transform", function(d) {  return "translate( 0 , "+ (radius+110) + ")"; })
	  .attr("text-anchor"  , "middle" )
	  .attr("dy", "0.35em")
	  .attr("font-family" , "Proxima Nova")
	  .attr("font-size" , "18")
	  .attr("fill",prop.legendFakt)
	  .text(currencySwapDef ( data[1])  );
}

function percentsAndCaption(data, caption, showPercents){
	if (showPercents === undefined) {
        showPercents = true;
	}

	if (showPercents) {
		donut.select(".arc").
		append("text")
			  .attr("transform", function(d) {  return "translate(5, 0)"; })
			  .attr("text-anchor"  , "middle" )
			  .attr("dy", "0.35em")
			  .attr("font-family" , "Proxima Nova")
			  .attr("font-size" , "20")
	//		  .attr("font-weight" , "bold")
			  .text(function(d) {  return  ( (   data [1] / data[0] ) * 100).toFixed(1)   + '%'; });
	}
	
	donut.select(".arc").
	append("text")
		  .attr("transform", function(d) {  return "translate( 0 , "+ (radius+20) + ")"; })
		  .attr("text-anchor"  , "middle" )
		  .attr("class"  , "captionLegend" )
		  .attr("dy", "0.35em")
		  .attr("font-family" , "Proxima Nova")
		  .attr("font-size" , "23")
		  .text(caption);
}

function overGraph(data){

	overGraf = g.append("g")
			.attr("class", "overGraf");
	
	var pie = d3.pie().sort(null).value(function(d , i ) {	return d; })				
	.startAngle(0)
	.endAngle(6.28* ( data[1] / data[0]) );
	
	var path = d3.arc()
				.outerRadius(radius)
				.innerRadius(40);
	var arc = overGraf.selectAll(".arc2")
							.data( pie( [0, 1 ] ) ).enter().append("g")
													.attr("class", "arc2");
	arc.append("path")
		.attr("d", path)
		.attr("fill", function(d , i ) { return prop.colorOverGraph; });

}


function currencySwapDef(d){
	return (d.toString()).replace(/\B(?=(\d{3})+(?!\d))/g, " ")  + " " + prop.units;
}








