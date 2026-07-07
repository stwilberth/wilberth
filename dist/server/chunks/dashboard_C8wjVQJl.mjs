import { r as __exportAll } from "./rolldown-runtime_CE-6LUnI.mjs";
import { S as createComponent, g as addAttribute, h as renderHead, u as renderTemplate, x as createAstro } from "./server_CQJ3K2N-.mjs";
import "./compiler_BQChIv4S.mjs";
import { r as isAuthenticated } from "./auth_Ba7W2vS-.mjs";
import { i as getQuotes } from "./db_D71H01lX.mjs";
//#region src/pages/admin/dashboard.astro
var dashboard_exports = /* @__PURE__ */ __exportAll({
	default: () => $$Dashboard,
	file: () => $$file,
	prerender: () => false,
	url: () => $$url
});
createAstro("https://astro.build");
var $$Dashboard = createComponent(async ($$result, $$props, $$slots) => {
	const Astro = $$result.createAstro($$props, $$slots);
	Astro.self = $$Dashboard;
	if (!isAuthenticated(Astro.request)) return Astro.redirect("/admin/");
	const quotes = await getQuotes();
	const stats = {
		total: quotes.length,
		pendientes: quotes.filter((q) => q.status === "pendiente").length,
		aprobadas: quotes.filter((q) => q.status === "aprobada").length,
		rechazadas: quotes.filter((q) => q.status === "rechazada").length
	};
	function formatCurrency(n) {
		return new Intl.NumberFormat("es-CR", {
			style: "currency",
			currency: "CRC",
			minimumFractionDigits: 0,
			maximumFractionDigits: 0
		}).format(n);
	}
	function formatDate(d) {
		return (/* @__PURE__ */ new Date(d + "Z")).toLocaleDateString("es-CR", {
			year: "numeric",
			month: "short",
			day: "numeric",
			hour: "2-digit",
			minute: "2-digit"
		});
	}
	function statusBadge(status) {
		return {
			pendiente: "bg-amber-100 text-amber-800",
			aprobada: "bg-emerald-100 text-emerald-800",
			rechazada: "bg-red-100 text-red-800"
		}[status] || "bg-slate-100 text-slate-800";
	}
	return renderTemplate`<html lang="es" data-astro-cid-qknfvum6><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Dashboard - Admin Wilberth</title>${renderHead($$result)}</head><body class="bg-slate-50 min-h-screen" data-astro-cid-qknfvum6><header class="bg-white border-b border-slate-200 sticky top-0 z-50" data-astro-cid-qknfvum6><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between" data-astro-cid-qknfvum6><div class="flex items-center gap-4" data-astro-cid-qknfvum6><h1 class="text-xl font-black text-slate-900" data-astro-cid-qknfvum6>Admin</h1><nav class="hidden md:flex items-center gap-1 ml-4" data-astro-cid-qknfvum6><a href="/admin/dashboard" class="px-4 py-2 text-sm font-medium bg-indigo-50 text-indigo-700 rounded-lg" data-astro-cid-qknfvum6>Cotizaciones</a><a href="/admin/crear" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" data-astro-cid-qknfvum6>Nueva Cotización</a></nav></div><div class="flex items-center gap-3" data-astro-cid-qknfvum6><a href="/" class="text-sm text-slate-500 hover:text-slate-700" data-astro-cid-qknfvum6>Ver sitio</a><form method="POST" action="/admin/logout" data-astro-cid-qknfvum6><button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium" data-astro-cid-qknfvum6>Cerrar sesión</button></form></div></div></header><main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" data-astro-cid-qknfvum6><div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8" data-astro-cid-qknfvum6><div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200" data-astro-cid-qknfvum6><p class="text-3xl font-black text-slate-900" data-astro-cid-qknfvum6>${stats.total}</p><p class="text-sm text-slate-500 mt-1" data-astro-cid-qknfvum6>Totales</p></div><div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200" data-astro-cid-qknfvum6><p class="text-3xl font-black text-amber-600" data-astro-cid-qknfvum6>${stats.pendientes}</p><p class="text-sm text-slate-500 mt-1" data-astro-cid-qknfvum6>Pendientes</p></div><div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200" data-astro-cid-qknfvum6><p class="text-3xl font-black text-emerald-600" data-astro-cid-qknfvum6>${stats.aprobadas}</p><p class="text-sm text-slate-500 mt-1" data-astro-cid-qknfvum6>Aprobadas</p></div><div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200" data-astro-cid-qknfvum6><p class="text-3xl font-black text-red-600" data-astro-cid-qknfvum6>${stats.rechazadas}</p><p class="text-sm text-slate-500 mt-1" data-astro-cid-qknfvum6>Rechazadas</p></div></div><div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden" data-astro-cid-qknfvum6><div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between" data-astro-cid-qknfvum6><h2 class="text-lg font-bold text-slate-900" data-astro-cid-qknfvum6>Cotizaciones</h2><a href="/admin/crear" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold px-4 py-2 rounded-lg transition-colors" data-astro-cid-qknfvum6>+ Nueva</a></div>${quotes.length === 0 ? renderTemplate`<div class="p-12 text-center text-slate-400" data-astro-cid-qknfvum6><p class="text-lg" data-astro-cid-qknfvum6>No hay cotizaciones aún</p><a href="/admin/crear" class="text-indigo-600 hover:text-indigo-800 font-medium text-sm mt-2 inline-block" data-astro-cid-qknfvum6>Crear la primera</a></div>` : renderTemplate`<div class="overflow-x-auto" data-astro-cid-qknfvum6><table class="w-full text-sm" data-astro-cid-qknfvum6><thead class="bg-slate-50 text-slate-600 text-xs uppercase tracking-wider" data-astro-cid-qknfvum6><tr data-astro-cid-qknfvum6><th class="text-left px-6 py-3 font-medium" data-astro-cid-qknfvum6>Cliente</th><th class="text-left px-6 py-3 font-medium" data-astro-cid-qknfvum6>Contacto</th><th class="text-right px-6 py-3 font-medium" data-astro-cid-qknfvum6>Total</th><th class="text-center px-6 py-3 font-medium" data-astro-cid-qknfvum6>Estado</th><th class="text-left px-6 py-3 font-medium" data-astro-cid-qknfvum6>Fecha</th><th class="text-center px-6 py-3 font-medium" data-astro-cid-qknfvum6>Acción</th></tr></thead><tbody class="divide-y divide-slate-100" data-astro-cid-qknfvum6>${quotes.map((q) => renderTemplate`<tr class="hover:bg-slate-50 transition-colors" data-astro-cid-qknfvum6><td class="px-6 py-4 font-medium text-slate-900" data-astro-cid-qknfvum6>${q.client_name}</td><td class="px-6 py-4 text-slate-500" data-astro-cid-qknfvum6><div data-astro-cid-qknfvum6>${q.client_email}</div><div class="text-xs" data-astro-cid-qknfvum6>${q.client_phone}</div></td><td class="px-6 py-4 text-right font-mono font-medium" data-astro-cid-qknfvum6>${formatCurrency(q.total)}</td><td class="px-6 py-4 text-center" data-astro-cid-qknfvum6><span${addAttribute(`inline-block px-3 py-1 rounded-full text-xs font-bold ${statusBadge(q.status)}`, "class")} data-astro-cid-qknfvum6>${q.status}</span></td><td class="px-6 py-4 text-slate-500 text-xs" data-astro-cid-qknfvum6>${formatDate(q.created_at)}</td><td class="px-6 py-4 text-center" data-astro-cid-qknfvum6><a${addAttribute(`/admin/ver/${q.id}`, "href")} class="text-indigo-600 hover:text-indigo-800 text-sm font-medium" data-astro-cid-qknfvum6>Ver</a></td></tr>`)}</tbody></table></div>`}</div></main></body></html>`;
}, "C:/Users/Wilberth/projects/wilberth/src/pages/admin/dashboard.astro", void 0);
var $$file = "C:/Users/Wilberth/projects/wilberth/src/pages/admin/dashboard.astro";
var $$url = "/admin/dashboard";
//#endregion
//#region \0virtual:astro:page:src/pages/admin/dashboard@_@astro
var page = () => dashboard_exports;
//#endregion
export { page };
