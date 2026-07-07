import { createClient } from "@libsql/client";
//#region src/lib/db.ts
var readClient = createClient({
	url: "libsql://wilberth-stwilberth.aws-us-east-1.turso.io",
	authToken: Object.assign({
		"ASSETS_PREFIX": void 0,
		"BASE_URL": "/",
		"DEV": false,
		"MODE": "production",
		"PROD": true,
		"SITE": void 0,
		"SSR": true
	}, {})?.TURSO_READ_ONLY || process.env.TURSO_READ_ONLY
});
var writeClient = createClient({
	url: "libsql://wilberth-stwilberth.aws-us-east-1.turso.io",
	authToken: Object.assign({
		"ASSETS_PREFIX": void 0,
		"BASE_URL": "/",
		"DEV": false,
		"MODE": "production",
		"PROD": true,
		"SITE": void 0,
		"SSR": true
	}, {})?.TURSO_READ_WRITE || process.env.TURSO_READ_WRITE
});
async function getServices() {
	return (await readClient.execute("SELECT * FROM services")).rows;
}
async function createQuote(client_name, client_email, client_phone, notes, items, tax_rate = 13) {
	const subtotal = items.reduce((sum, item) => sum + item.quantity * item.unit_price, 0);
	const tax_amount = subtotal * (tax_rate / 100);
	const total = subtotal + tax_amount;
	const result = await writeClient.execute({
		sql: `INSERT INTO quotes (client_name, client_email, client_phone, notes, subtotal, tax_rate, tax_amount, total)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)`,
		args: [
			client_name,
			client_email,
			client_phone,
			notes,
			subtotal,
			tax_rate,
			tax_amount,
			total
		]
	});
	const quoteId = Number(result.lastInsertRowid);
	for (const item of items) {
		const totalPrice = item.quantity * item.unit_price;
		await writeClient.execute({
			sql: "INSERT INTO quote_items (quote_id, description, quantity, unit_price, total_price) VALUES (?, ?, ?, ?, ?)",
			args: [
				quoteId,
				item.description,
				item.quantity,
				item.unit_price,
				totalPrice
			]
		});
	}
	return quoteId;
}
async function getQuotes() {
	const quotes = (await readClient.execute("SELECT * FROM quotes ORDER BY created_at DESC")).rows;
	for (const quote of quotes) quote.items = (await readClient.execute({
		sql: "SELECT * FROM quote_items WHERE quote_id = ?",
		args: [quote.id]
	})).rows;
	return quotes;
}
async function getQuoteById(id) {
	const result = await readClient.execute({
		sql: "SELECT * FROM quotes WHERE id = ?",
		args: [id]
	});
	if (result.rows.length === 0) return null;
	const quote = result.rows[0];
	quote.items = (await readClient.execute({
		sql: "SELECT * FROM quote_items WHERE quote_id = ?",
		args: [quote.id]
	})).rows;
	return quote;
}
async function updateQuoteStatus(id, status) {
	await writeClient.execute({
		sql: "UPDATE quotes SET status = ? WHERE id = ?",
		args: [status, id]
	});
}
async function deleteQuote(id) {
	await writeClient.execute({
		sql: "DELETE FROM quote_items WHERE quote_id = ?",
		args: [id]
	});
	await writeClient.execute({
		sql: "DELETE FROM quotes WHERE id = ?",
		args: [id]
	});
}
//#endregion
export { getServices as a, getQuotes as i, deleteQuote as n, updateQuoteStatus as o, getQuoteById as r, createQuote as t };
