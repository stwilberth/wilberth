import crypto from 'node:crypto';

const TOKEN_NAME = 'admin_token';

function getAdminPassword(): string {
  return process.env.ADMIN_PASSWORD || 'admin123';
}

export function hashPassword(password: string): string {
  return crypto.createHash('sha256').update(password).digest('hex');
}

export function verifyPassword(password: string): boolean {
  return password === getAdminPassword();
}

export function verifyToken(token: string): boolean {
  const expected = hashPassword(getAdminPassword());
  return token === expected;
}

export function generateToken(): string {
  return hashPassword(getAdminPassword());
}

export function getTokenCookieValue(): string {
  return generateToken();
}

export function getSessionCookieHeader(): string {
  const token = getTokenCookieValue();
  return `${TOKEN_NAME}=${token}; Path=/; HttpOnly; SameSite=Strict; Max-Age=86400`;
}

export function getClearCookieHeader(): string {
  return `${TOKEN_NAME}=; Path=/; HttpOnly; SameSite=Strict; Max-Age=0`;
}

export function getTokenFromCookies(request: Request): string | null {
  const cookieHeader = request.headers.get('cookie');
  if (!cookieHeader) return null;

  const cookies = cookieHeader.split(';').map(c => c.trim());
  for (const cookie of cookies) {
    const [name, value] = cookie.split('=');
    if (name === TOKEN_NAME) return value;
  }
  return null;
}

export function isAuthenticated(request: Request): boolean {
  const token = getTokenFromCookies(request);
  if (!token) return false;
  return verifyToken(token);
}
