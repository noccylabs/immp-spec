# Encryption and Signing

## Key exchange

To facilitate the ability to transport messages in an encrypted fashion, IMMP implements a key-exchange protocol similar to that used by pgp/gpg. This way, the sending mta can request the recipients key from the receiving mta in order to sign the message.

 1. `alice@a.com` sends a message to `bob@b.com` via her MTA `a.com`.
 2. `a.com` doesn't have the public key for `bob@b.com` on file in alice's address book, so it connects to `b.com`, upgrades the connection, authenticates itself (causing `b.com` to connect back to `a.com`) and then sends a key query request for the address.
 3. `b.com` sends the public key it has on file.
 4. `a.com` can now create the inner envelope and encrypt it before signing the outer envelope with it's private key.
 5. `a.com` now sends the full envelope over the same connection that it received the key over.

### Example session

~~~~
    S:  100- IMMP/1.0 Server at b.com
    S:  100  Please upgrade the connection to one of the following:
    S:  102 TLS2 SSL3
    S:  101 p=IMMP v=1.0 d=immp.b.com
    C:  UPGRADE TLS2
    S:  204 Upgrading to TLS2.
    --- Connection is upgraded, everything past this point is encrypted ---
    C:  AUTH COOKIE c1295ff8d04b21321cb3ffdda a.com
    S:  301 Cookie authentication request initiated.
    S:  210 Authentication accepted for mailer-daemon@a.com
    C:  KEY REQUEST b.com
    S:  2x0 Public key for b.com (fingerprint 0x00000000):
    S:  2x1- ...key...
    S:  2x1  ...key
    --- a.com now has public key and can encrypt the envelope if needed ---
    C:  DELIVER TO b.com
        ...
~~~~
