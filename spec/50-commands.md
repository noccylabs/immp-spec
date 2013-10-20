\newpage

# Commands and Responses

## Commands

Commands come in the form of one or more keywords, followed by zero or more
parameters or switches:

~~~~
  AUTHENTICATE COOKIE cacabeefcacabad0 otherdomain.com
        |                     |               |
  AUTHENTICATE SECRET noccy@noccylabs.info    |
        |                     |---------------'
        '-----.               | 
           Keywords        Parameters    Switches
              |               |              '---------------------.
              |               |                                    |
  AS beef MBOX FETCH /inbox#9507ce26-d34e-41cb-9f14-4eeff943e25e +JSON -READ
        |
   Pipeline ID
~~~~

 * Keywords are written in `CAPITAL LETTERS` in this document but the parsers
   SHOULD NOT be case sensitive when parsing keywords.
 * Words in lower case should be replaced with the appropriate values.
 * Quoted strings should be used verbatim.
 * Parameters only have to be quoted if they contain spaces.
 * Switches enable or disable a certain behavior of the command.
 * Pipelines can be created by prefixing the keyword `AS` followed by the
   desired pipeline ID to use. All replies for this pipeline will have this ID
   followed by a colon prefixed to their status codes.

## Responses

~~~~
  [ pipeline ": "] statuscode ["-"] " " message "\n"
       |                |       |           |      '-- Ends with newline
       |                |       |           '-- The message
       |                |       '-------- Dash for continuation
       |                '------ The numeric status code
       '------ The pipeline ID as defined with "AS"
~~~~

## Examples

### Upgrading a connection



~~~~
 S:  100- IMMP/1.0 Server at noccylabs.info.
 S:  100- Please upgrade the connection to one of the following:
 S:  100    TLS2 TLS3 
 S:  101 p=IMMP v=1.0 d=noccylabs.info
 C:  UPGRADE TLS3
 S:  204 Upgrading to TLS3.
           //
       Handshake
           //
     Encrypted Transport
~~~~

### Authentication

The authentication in IMMP is very different from previously implemented
algorithms in existing mail protocols. In IMMP both servers and clients must
authenticate. However, the servers authenticate by providing a cookie, thus
providing verification of the origin domain.

~~~~
 C:  AUTH COOKIE c2a9ff172404b21391cbaffbd9 mydomain.com
 S:  301 Cookie authentication request initiated.
 S:  210 Authentication accepted for mailer-daemon@mydomain.com
~~~~

And authentication with a shared secret:

~~~~
 C:  AUTH SECRET noccy@noccylabs.info "Desktop Computer (Mail Client)"
 S:  302 Shared secret authentication request intiated.
 S:  303 n1=24c17bb6-11ef-4cfa-8c5c-440ceadc8431 n2=1381978910
 C:  AUTH RESPONSE 8843d7f92416211de9ebb963ff4ce28125932878
 S:  210 Authenication accepted for noccy@noccylabs.info
~~~~

### Reading Mail


~~~~
 C:  MBOX CHECK /inbox::* +RECURSIVE
 S:  240- /inbox::* u=24 t=1194
 S:  240- /inbox/lists::* u=9 t=502
 S:  240 /inbox/receipts::* u=1 t=105
 C:  AS f9ca MBOX INDEX /inbox::unread +JSON
 C:  AS ab34 MBOX INDEX /inbox/lists::unread +JSON
 ..
~~~~

> *Here pipelined transactions begin, we will follow the `f9ca` pipeline*

~~~~
 S:  f9ca: 250- { "_id":"mydomain_com.4933a1ff", "from":"bob@mydomain.com", ... }
 S:  f9ca: 250 
~~~~

