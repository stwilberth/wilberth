import { r as __exportAll } from "./rolldown-runtime_CE-6LUnI.mjs";
import { S as createComponent, h as renderHead, n as renderScript, u as renderTemplate, x as createAstro } from "./server_CQJ3K2N-.mjs";
import "./compiler_BQChIv4S.mjs";
import { r as isAuthenticated } from "./auth_Ba7W2vS-.mjs";
import { a as getServices, t as createQuote } from "./db_D71H01lX.mjs";
//#region src/pages/admin/crear.astro
var crear_exports = /* @__PURE__ */ __exportAll({
	default: () => $$Crear,
	file: () => $$file,
	prerender: () => false,
	url: () => $$url
});
createAstro("https://astro.build");
var $$Crear = createComponent(async ($$result, $$props, $$slots) => {
	const Astro = $$result.createAstro($$props, $$slots);
	Astro.self = $$Crear;
	if (!isAuthenticated(Astro.request)) return Astro.redirect("/admin/");
	await getServices();
	if (Astro.request.method === "POST") {
		const formData = await Astro.request.formData();
		const client_name = formData.get("client_name")?.toString() || "";
		const client_email = formData.get("client_email")?.toString() || "";
		const client_phone = formData.get("client_phone")?.toString() || "";
		const notes = formData.get("notes")?.toString() || "";
		const descriptions = formData.getAll("item_description[]");
		const quantities = formData.getAll("item_quantity[]");
		const prices = formData.getAll("item_price[]");
		const items = descriptions.map((desc, i) => ({
			description: desc,
			quantity: parseInt(quantities[i] || "1"),
			unit_price: parseFloat(prices[i] || "0")
		})).filter((item) => item.description && item.unit_price > 0);
		if (client_name && items.length > 0) {
			const id = await createQuote(client_name, client_email, client_phone, notes, items);
			return Astro.redirect(`/admin/ver/${id}`);
		}
	}
	return renderTemplate`<html lang="es" data-astro-cid-gejitegp><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Nueva Cotización - Admin Wilberth</title>${renderHead($$result)}</head><body class="bg-slate-50 min-h-screen" data-astro-cid-gejitegp><header class="bg-white border-b border-slate-200 sticky top-0 z-50" data-astro-cid-gejitegp><div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between" data-astro-cid-gejitegp><div class="flex items-center gap-4" data-astro-cid-gejitegp><h1 class="text-xl font-black text-slate-900" data-astro-cid-gejitegp>Admin</h1><nav class="hidden md:flex items-center gap-1 ml-4" data-astro-cid-gejitegp><a href="/admin/dashboard" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all" data-astro-cid-gejitegp>Cotizaciones</a><a href="/admin/crear" class="px-4 py-2 text-sm font-medium bg-indigo-50 text-indigo-700 rounded-lg" data-astro-cid-gejitegp>Nueva Cotización</a></nav></div><a href="/admin/dashboard" class="text-sm text-slate-500 hover:text-slate-700" data-astro-cid-gejitegp>← Volver</a></div></header><main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8" data-astro-cid-gejitegp><h2 class="text-2xl font-black text-slate-900 mb-8" data-astro-cid-gejitegp>Nueva Cotización</h2><form method="POST" id="quote-form" class="space-y-6" data-astro-cid-gejitegp><div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-4" data-astro-cid-gejitegp><h3 class="text-lg font-bold text-slate-900" data-astro-cid-gejitegp>Datos del Cliente</h3><div class="grid grid-cols-1 md:grid-cols-2 gap-4" data-astro-cid-gejitegp><div data-astro-cid-gejitegp><label for="client_name" class="block text-sm font-medium text-slate-700 mb-1" data-astro-cid-gejitegp>Nombre *</label><input type="text" id="client_name" name="client_name" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" data-astro-cid-gejitegp></div><div data-astro-cid-gejitegp><label for="client_email" class="block text-sm font-medium text-slate-700 mb-1" data-astro-cid-gejitegp>Email *</label><input type="email" id="client_email" name="client_email" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" data-astro-cid-gejitegp></div><div data-astro-cid-gejitegp><label for="client_phone" class="block text-sm font-medium text-slate-700 mb-1" data-astro-cid-gejitegp>Teléfono *</label><input type="tel" id="client_phone" name="client_phone" required class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" data-astro-cid-gejitegp></div></div></div><div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-4" data-astro-cid-gejitegp><div class="flex items-center justify-between" data-astro-cid-gejitegp><h3 class="text-lg font-bold text-slate-900" data-astro-cid-gejitegp>Servicios / Items</h3><button type="button" id="add-item" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium" data-astro-cid-gejitegp>+ Agregar item</button></div><div id="items-container" class="space-y-3" data-astro-cid-gejitegp><div class="item-row grid grid-cols-1 md:grid-cols-[1fr_80px_120px] gap-3 items-start" data-astro-cid-gejitegp><div data-astro-cid-gejitegp><label class="block text-xs font-medium text-slate-500 mb-1" data-astro-cid-gejitegp>Descripción</label><input type="text" name="item_description[]" required class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm" data-astro-cid-gejitegp></div><div data-astro-cid-gejitegp><label class="block text-xs font-medium text-slate-500 mb-1" data-astro-cid-gejitegp>Cant.</label><input type="number" name="item_quantity[]" value="1" min="1" required class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm" data-astro-cid-gejitegp></div><div class="flex gap-2" data-astro-cid-gejitegp><div class="flex-1" data-astro-cid-gejitegp><label class="block text-xs font-medium text-slate-500 mb-1" data-astro-cid-gejitegp>Precio</label><input type="number" name="item_price[]" step="0.01" min="0" required class="w-full px-3 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none text-sm" data-astro-cid-gejitegp></div><button type="button" class="remove-item mt-5 p-2.5 text-red-400 hover:text-red-600 transition-colors hidden" data-astro-cid-gejitegp><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" data-astro-cid-gejitegp><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" data-astro-cid-gejitegp></path></svg></button></div></div></div><div class="border-t border-slate-100 pt-4 space-y-2" data-astro-cid-gejitegp><div class="flex justify-between text-sm text-slate-600" data-astro-cid-gejitegp><span data-astro-cid-gejitegp>Subtotal</span><span id="subtotal" data-astro-cid-gejitegp>₡0</span></div><div class="flex justify-between text-sm text-slate-600" data-astro-cid-gejitegp><span data-astro-cid-gejitegp>IVA (13%)</span><span id="tax" data-astro-cid-gejitegp>₡0</span></div><div class="flex justify-between text-lg font-bold text-slate-900 border-t border-slate-200 pt-2" data-astro-cid-gejitegp><span data-astro-cid-gejitegp>Total</span><span id="total" data-astro-cid-gejitegp>₡0</span></div></div></div><div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6" data-astro-cid-gejitegp><label for="notes" class="block text-sm font-medium text-slate-700 mb-1" data-astro-cid-gejitegp>Notas adicionales</label><textarea id="notes" name="notes" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none" data-astro-cid-gejitegp></textarea></div><div class="flex gap-3" data-astro-cid-gejitegp><button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3 rounded-xl transition-colors" data-astro-cid-gejitegp>Crear Cotización</button><a href="/admin/dashboard" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium px-8 py-3 rounded-xl transition-colors" data-astro-cid-gejitegp>Cancelar</a></div></form></main>${renderScript($$result, "C:/Users/Wilberth/projects/wilberth/src/pages/admin/crear.astro?astro&type=script&index=0&lang.ts")}</body></html>`;
}, "C:/Users/Wilberth/projects/wilberth/src/pages/admin/crear.astro", void 0);
var $$file = "C:/Users/Wilberth/projects/wilberth/src/pages/admin/crear.astro";
var $$url = "/admin/crear";
//#endregion
//#region \0virtual:astro:page:src/pages/admin/crear@_@astro
var page = () => crear_exports;
//#endregion
export { page };
