import { r as __exportAll } from "./rolldown-runtime_CE-6LUnI.mjs";
import { S as createComponent } from "./server_CQJ3K2N-.mjs";
import "./compiler_BQChIv4S.mjs";
import { t as getClearCookieHeader } from "./auth_Ba7W2vS-.mjs";
//#region src/pages/admin/logout.astro
var logout_exports = /* @__PURE__ */ __exportAll({
	default: () => $$Logout,
	file: () => $$file,
	prerender: () => false,
	url: () => $$url
});
var $$Logout = createComponent(($$result, $$props, $$slots) => {
	const headers = new Headers();
	headers.append("Set-Cookie", getClearCookieHeader());
	headers.append("Location", "/admin/");
	return new Response(null, {
		status: 302,
		headers
	});
}, "C:/Users/Wilberth/projects/wilberth/src/pages/admin/logout.astro", void 0);
var $$file = "C:/Users/Wilberth/projects/wilberth/src/pages/admin/logout.astro";
var $$url = "/admin/logout";
//#endregion
//#region \0virtual:astro:page:src/pages/admin/logout@_@astro
var page = () => logout_exports;
//#endregion
export { page };
