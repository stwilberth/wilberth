import crypto from "node:crypto";
//#region src/lib/auth.ts
var TOKEN_NAME = "admin_token";
function getAdminPassword() {
	return process.env.ADMIN_PASSWORD || "admin123";
}
function hashPassword(password) {
	return crypto.createHash("sha256").update(password).digest("hex");
}
function verifyPassword(password) {
	return password === getAdminPassword();
}
function verifyToken(token) {
	return token === hashPassword(getAdminPassword());
}
function generateToken() {
	return hashPassword(getAdminPassword());
}
function getTokenCookieValue() {
	return generateToken();
}
function getSessionCookieHeader() {
	return `${TOKEN_NAME}=${getTokenCookieValue()}; Path=/; HttpOnly; SameSite=Strict; Max-Age=86400`;
}
function getClearCookieHeader() {
	return `${TOKEN_NAME}=; Path=/; HttpOnly; SameSite=Strict; Max-Age=0`;
}
function getTokenFromCookies(request) {
	const cookieHeader = request.headers.get("cookie");
	if (!cookieHeader) return null;
	const cookies = cookieHeader.split(";").map((c) => c.trim());
	for (const cookie of cookies) {
		const [name, value] = cookie.split("=");
		if (name === TOKEN_NAME) return value;
	}
	return null;
}
function isAuthenticated(request) {
	const token = getTokenFromCookies(request);
	if (!token) return false;
	return verifyToken(token);
}
//#endregion
export { verifyPassword as i, getSessionCookieHeader as n, isAuthenticated as r, getClearCookieHeader as t };
