const app = {
	
	routes : {
		inisession : "/resources/views/auth/login.php",
		endsession : "/app/app.php?_logout",
		login : "/app/app.php",
		prevpost : "/app/app.php?_pp",
		lastpost : "/app/app.php?_lp",
		openpost : "/app/app.php?_op",
		newpost : "/resources/views/autores/newpost.php"
	},
	pp : $("#prev-post"),
	lp : $("#content"),
	op : $("#content"),

	views : function(route){
		location.replace(this.routes[route]);
	},
	previousPost : function(){
		let html = `<b>Aún no hay publicaciones en este blog</b>`;
		this.pp.html("");
		fetch(this.routes.prevpost)
			 .then(resp => resp.json())
			 .then(ppresp => {
			 	if(ppresp.length > 0){
			 		html = "";
			 		let primera = true;
			 		for(let post of ppresp){
			 			html += `
			 				<a href="#" onclick="app.openPost(event, ${post.id}, this)"
			 					class="mb-3 list-group-item list-group-item-action ${primera ? `active`:``} pplg">
			 					<div class="w-100 border-bottom">
			 						<h5 class="mb-1">${post.title}</h5>
			 						<small class="text-${primera ? `light` : `muted`}">
			 							<i class="bi bi-calendar3"></i> ${post.fecha}
			 						</small>
			 					</div>
			 					<small>
			 						<i class="bi bi-person-circle"></i>
			 						<b>${post.name}</b>
			 					</small>
			 				</a>
			 			`;
			 			primera = false;
			 		}
			 		this.pp.html(html);
			 	}
			 }).catch(err => console.error(err));
	},
	lastPost : function(limit){
		let html = "<h2>Aun no hay publicaciones</h2>"
		this.lp.html("");

		fetch(this.routes.lastpost + "&limit=" + limit)
			.then(response => response.json())
			.then(lpresp => {
				if(lpresp.length > 0){
					html = `
						<div class="w-100 border-bottom">
							<h5 class="mb-1">${lpresp[0].title}</h5>
							<small class="text-muted">
								<i class="bi bi-calendar-week"></i> ${lpresp[0].fecha} | 
								<i class="bi bi-person-circle"></i> ${lpresp[0].name}
							</small>
							<p class="mb-1 fs-4 border-bottom" style="text-align:justify;"">${lpresp[0].body}</p>
						</div>
					`;
				}
				this.lp.html(html);
			}).catch(err => console.error(err));
	},
	openPost : function(event, pid, element){
		event.preventDefault();
		let html = `<b>Aún no hay publicaciones en este blog</b>`;
		
		for(let e of this.pp.children(".active")){
			$(e).removeClass("active");
			
		}

		$(element).addClass("active");
		this.op.html("");

		fetch(this.routes.openpost + "&pid=" + pid)
			.then(response => response.json())
			.then(opresp => {
				if(opresp.length > 0){
					html = `
						<div class="w-100 border-bottom">
							<h5 class="mb-1">${opresp[0].title}</h5>
							<small class="text-muted">
								<i class="bi bi-calendar-week"></i> ${opresp[0].fecha} | 
								<i class="bi bi-person-circle"></i> ${opresp[0].name}
							</small>
							<p class="mb-1 fs-4 border-bottom" style="text-align:justify;">${opresp[0].body}</p>
						</div>
					`;
				}
				this.op.html(html);
			}).catch(err => console.error(err));
	}
}