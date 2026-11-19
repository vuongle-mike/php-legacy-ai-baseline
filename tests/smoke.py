"""Functional contract only; intentionally does not assert vulnerabilities remain."""
import http.cookiejar
import urllib.parse
import urllib.request

base = "http://127.0.0.1:8080"
def client():
    return urllib.request.build_opener(urllib.request.HTTPCookieProcessor(http.cookiejar.CookieJar()))
def get(c, path):
    return c.open(base + path).read().decode()
def post(c, path, data):
    return c.open(base + path, urllib.parse.urlencode(data).encode()).read().decode()

alice, bob = client(), client()
assert 'Login' in get(alice, '/')
assert 'Alice note' in post(alice, '/?action=login', dict(username='alice', password='alice-demo'))
assert 'Bob note' not in get(alice, '/')
assert 'Bob note' in post(bob, '/?action=login', dict(username='bob', password='bob-demo'))
assert 'Alice note' not in get(bob, '/')
assert 'Synthetic Alice content' in get(alice, '/?action=note&id=1')
post(alice, '/?action=create', dict(title='Smoke unique note', body='Smoke body'))
assert 'Smoke unique note' in get(alice, '/?q=Smoke')
assert 'Smoke unique note' not in get(bob, '/')
assert 'Synthetic export' in get(alice, '/?action=download&file=sample.txt')
assert 'Login' in get(alice, '/?action=logout')
print('PASS: login, owner-scoped listing, note read, create, search, export, logout')
