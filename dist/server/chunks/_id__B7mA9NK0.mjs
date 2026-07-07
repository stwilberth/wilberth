import { r as __exportAll } from "./rolldown-runtime_CE-6LUnI.mjs";
import { S as createComponent, g as addAttribute, h as renderHead, u as renderTemplate, x as createAstro } from "./server_CQJ3K2N-.mjs";
import "./compiler_BQChIv4S.mjs";
import { r as isAuthenticated } from "./auth_Ba7W2vS-.mjs";
import { n as deleteQuote, o as updateQuoteStatus, r as getQuoteById } from "./db_D71H01lX.mjs";
//#region src/pages/admin/ver/[id].astro
var _id__exports = /* @__PURE__ */ __exportAll({
	default: () => $$Id,
	file: () => $$file,
	prerender: () => false,
	url: () => $$url
});
createAstro("https://astro.build");
var $$Id = createComponent(async ($$result, $$props, $$slots) => {
	const Astro = $$result.createAstro($$props, $$slots);
	Astro.self = $$Id;
	if (!isAuthenticated(Astro.request)) return Astro.redirect("/admin/");
	const { id } = Astro.params;
	const quoteId = parseInt(id || "0");
	if (Astro.request.method === "POST") {
		const formData = await Astro.request.formData();
		const action = formData.get("_action")?.toString();
		if (action === "delete") {
			await deleteQuote(quoteId);
			return Astro.redirect("/admin/dashboard");
		}
		if (action === "status") await updateQuoteStatus(quoteId, formData.get("status")?.toString() || "pendiente");
	}
	const quote = await getQuoteById(quoteId);
	if (!quote) return Astro.redirect("/admin/dashboard");
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
			month: "long",
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
	return renderTemplate`<html lang="es" data-astro-cid-zwu7n4km><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Cotización #${quote.id} - Admin Wilberth</title>${renderHead($$result)}</head><body class="bg-slate-50 min-h-screen" data-astro-cid-zwu7n4km><header class="bg-white border-b border-slate-200 sticky top-0 z-50" data-astro-cid-zwu7n4km><div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between" data-astro-cid-zwu7n4km><div class="flex items-center gap-4" data-astro-cid-zwu7n4km><h1 class="text-xl font-black text-slate-900" data-astro-cid-zwu7n4km>Cotización #${quote.id}</h1><span${addAttribute(`inline-block px-3 py-1 rounded-full text-xs font-bold ${statusBadge(quote.status)}`, "class")} data-astro-cid-zwu7n4km>${quote.status}</span></div><a href="/admin/dashboard" class="text-sm text-slate-500 hover:text-slate-700" data-astro-cid-zwu7n4km>← Volver</a></div></header><main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8" data-astro-cid-zwu7n4km><div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-6" data-astro-cid-zwu7n4km><div class="flex justify-between items-start mb-8" data-astro-cid-zwu7n4km><div data-astro-cid-zwu7n4km><h2 class="text-2xl font-black text-slate-900 mb-1" data-astro-cid-zwu7n4km>Cotización #${quote.id}</h2><p class="text-sm text-slate-500" data-astro-cid-zwu7n4km>Creada el ${formatDate(quote.created_at)}</p></div></div><div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 p-6 bg-slate-50 rounded-xl" data-astro-cid-zwu7n4km><div data-astro-cid-zwu7n4km><p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1" data-astro-cid-zwu7n4km>Cliente</p><p class="font-bold text-slate-900" data-astro-cid-zwu7n4km>${quote.client_name}</p></div><div data-astro-cid-zwu7n4km><p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1" data-astro-cid-zwu7n4km>Email</p><p class="text-slate-700" data-astro-cid-zwu7n4km>${quote.client_email}</p></div><div data-astro-cid-zwu7n4km><p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1" data-astro-cid-zwu7n4km>Teléfono</p><p class="text-slate-700" data-astro-cid-zwu7n4km>${quote.client_phone}</p></div></div><table class="w-full mb-6" data-astro-cid-zwu7n4km><thead data-astro-cid-zwu7n4km><tr class="border-b border-slate-200 text-xs uppercase tracking-wider text-slate-500" data-astro-cid-zwu7n4km><th class="text-left pb-3 font-medium" data-astro-cid-zwu7n4km>Descripción</th><th class="text-center pb-3 font-medium" data-astro-cid-zwu7n4km>Cantidad</th><th class="text-right pb-3 font-medium" data-astro-cid-zwu7n4km>P. Unitario</th><th class="text-right pb-3 font-medium" data-astro-cid-zwu7n4km>Total</th></tr></thead><tbody class="divide-y divide-slate-100" data-astro-cid-zwu7n4km>${quote.items.map((item) => renderTemplate`<tr class="text-sm" data-astro-cid-zwu7n4km><td class="py-3 text-slate-900" data-astro-cid-zwu7n4km>${item.description}</td><td class="py-3 text-center text-slate-600" data-astro-cid-zwu7n4km>${item.quantity}</td><td class="py-3 text-right font-mono" data-astro-cid-zwu7n4km>${formatCurrency(item.unit_price)}</td><td class="py-3 text-right font-mono font-medium" data-astro-cid-zwu7n4km>${formatCurrency(item.total_price)}</td></tr>`)}</tbody></table><div class="border-t border-slate-200 pt-4 space-y-2 ml-auto w-72" data-astro-cid-zwu7n4km><div class="flex justify-between text-sm text-slate-600" data-astro-cid-zwu7n4km><span data-astro-cid-zwu7n4km>Subtotal</span><span class="font-mono" data-astro-cid-zwu7n4km>${formatCurrency(quote.subtotal)}</span></div><div class="flex justify-between text-sm text-slate-600" data-astro-cid-zwu7n4km><span data-astro-cid-zwu7n4km>IVA (${quote.tax_rate}%)</span><span class="font-mono" data-astro-cid-zwu7n4km>${formatCurrency(quote.tax_amount)}</span></div><div class="flex justify-between text-lg font-bold text-slate-900 border-t border-slate-200 pt-2" data-astro-cid-zwu7n4km><span data-astro-cid-zwu7n4km>Total</span><span class="font-mono" data-astro-cid-zwu7n4km>${formatCurrency(quote.total)}</span></div></div>${quote.notes && renderTemplate`<div class="mt-6 p-4 bg-slate-50 rounded-xl" data-astro-cid-zwu7n4km><p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-2" data-astro-cid-zwu7n4km>Notas</p><p class="text-sm text-slate-700 whitespace-pre-wrap" data-astro-cid-zwu7n4km>${quote.notes}</p></div>`}</div><div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6" data-astro-cid-zwu7n4km><h3 class="text-lg font-bold text-slate-900 mb-4" data-astro-cid-zwu7n4km>Acciones</h3><div class="flex flex-wrap gap-3" data-astro-cid-zwu7n4km><form method="POST" class="inline" data-astro-cid-zwu7n4km><input type="hidden" name="_action" value="status" data-astro-cid-zwu7n4km><input type="hidden" name="status" value="aprobada" data-astro-cid-zwu7n4km><button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors" data-astro-cid-zwu7n4km>Aprobar</button></form><form method="POST" class="inline" data-astro-cid-zwu7n4km><input type="hidden" name="_action" value="status" data-astro-cid-zwu7n4km><input type="hidden" name="status" value="rechazada" data-astro-cid-zwu7n4km><button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors" data-astro-cid-zwu7n4km>Rechazar</button></form><form method="POST" class="inline" data-astro-cid-zwu7n4km><input type="hidden" name="_action" value="status" data-astro-cid-zwu7n4km><input type="hidden" name="status" value="pendiente" data-astro-cid-zwu7n4km><button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold px-5 py-2.5 rounded-lg transition-colors" data-astro-cid-zwu7n4km>Marcar Pendiente</button></form><form method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta cotización?')" data-astro-cid-zwu7n4km><input type="hidden" name="_action" value="delete" data-astro-cid-zwu7n4km><button type="submit" class="bg-white border border-red-300 text-red-600 hover:bg-red-50 text-sm font-medium px-5 py-2.5 rounded-lg transition-colors" data-astro-cid-zwu7n4km>Eliminar</button></form></div></div></main></body></html>`;
}, "C:/Users/Wilberth/projects/wilberth/src/pages/admin/ver/[id].astro", void 0);
var $$file = "C:/Users/Wilberth/projects/wilberth/src/pages/admin/ver/[id].astro";
var $$url = "/admin/ver/[id]";
//#endregion
//#region \0virtual:astro:page:src/pages/admin/ver/[id]@_@astro
var page = () => _id__exports;
//#endregion
export { page };
