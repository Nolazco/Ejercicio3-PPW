const app_myposts = {
	url : "app/app.php",

	mp : $("#my-posts"),

	getMyPosts : function(uid){
		let html = `<tr><td colspan="3">Aun no hay publicaciones</td></tr>`;
		this.mp.html(html);
		fetch(this.url + "?_mp&uid=" + uid)
			.then(resp => resp.json())
			.then(mpresp => {
				if(mpresp.length() > 0){
					html = "";
					for(let post of mpresp){
						html += `<tr>
									<td>${post.title}</td>
									<td>${post.created_at}</td>
									<td>${post.id} <i class="bi bi-trash3"></i></td>
								</tr>`;
					}
				}
				this.mp.html(html);
			}).catch(err => console.error(err));
	}
}