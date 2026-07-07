import { r as __exportAll } from "./rolldown-runtime_CE-6LUnI.mjs";
import { S as createComponent, h as renderHead, u as renderTemplate, x as createAstro } from "./server_CQJ3K2N-.mjs";
import "./compiler_BQChIv4S.mjs";
import { i as verifyPassword, n as getSessionCookieHeader, r as isAuthenticated } from "./auth_Ba7W2vS-.mjs";
//#region src/pages/admin/index.astro
var admin_exports = /* @__PURE__ */ __exportAll({
	default: () => $$Index,
	file: () => $$file,
	prerender: () => false,
	url: () => $$url
});
createAstro("https://astro.build");
var $$Index = createComponent(async ($$result, $$props, $$slots) => {
	const Astro = $$result.createAstro($$props, $$slots);
	Astro.self = $$Index;
	if (Astro.request.method === "POST") if (verifyPassword((await Astro.request.formData()).get("password")?.toString() || "")) {
		const headers = new Headers();
		headers.append("Set-Cookie", getSessionCookieHeader());
		headers.append("Location", "/admin/dashboard");
		return new Response(null, {
			status: 302,
			headers
		});
	} else return new Response(null, {
		status: 302,
		headers: { Location: "/admin/?error=1" }
	});
	if (isAuthenticated(Astro.request)) return Astro.redirect("/admin/dashboard");
	const error = Astro.url.searchParams.get("error");
	return renderTemplate`<html lang="es" data-astro-cid-nsou3le4><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Admin - Wilberth</title>${renderHead($$result)}</head><body class="bg-slate-100 min-h-screen flex items-center justify-center" data-astro-cid-nsou3le4><div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-sm" data-astro-cid-nsou3le4><div class="text-center mb-8" data-astro-cid-nsou3le4><h1 class="text-2xl font-black text-slate-900" data-astro-cid-nsou3le4>Panel Admin</h1><p class="text-slate-500 text-sm mt-1" data-astro-cid-nsou3le4>Ingresa tu contraseña</p></div>${error && renderTemplate`<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm mb-6" data-astro-cid-nsou3le4>Contraseña incorrecta</div>`}<form method="POST" class="space-y-4" data-astro-cid-nsou3le4><div data-astro-cid-nsou3le4><label for="password" class="block text-sm font-medium text-slate-700 mb-1" data-astro-cid-nsou3le4>Contraseña</label><input type="password" id="password" name="password" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="••••••••" data-astro-cid-nsou3le4></div><button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-xl transition-colors" data-astro-cid-nsou3le4>Ingresar</button></form></div></body></html>`;
}, "C:/Users/Wilberth/projects/wilberth/src/pages/admin/index.astro", void 0);
var $$file = "C:/Users/Wilberth/projects/wilberth/src/pages/admin/index.astro";
var $$url = "/admin";
//#endregion
//#region \0virtual:astro:page:src/pages/admin/index@_@astro
var page = () => admin_exports;
//#endregion
export { page };
