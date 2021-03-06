## IMIDs

IMID stands for Internet Mail (or Messaging) ID. To be compatible with XMPP, IMIDs follow the same format with a few specifics. First, look at this JID (Jabber ID) format:

      [xmpp:]alice@a.com[/resource]

Compare to IMID format:

      [imid:]alice@a.com[/mailbox[#message]][?options]
      [imid:]alice[+mailbox]@a.com

You can direct messages to folders by appending a plus-sign
followed by an existing folder name, for example:

~~~~
  alice@domain.com
   |--INBOX
   |   |--Receipts
   |   '--Mailinglists
   |--DRAFTS
   |--SENT
   '--JUNK
~~~~

Alice could in this case get her mailing list subscriptions (the involuntary kind) directed to the `:inbox/Mailinglists` folder by providing her IMID as `alice+mailinglists@domain.com`. Servers implementing IMMP MUST respect the folder redirections, and websites supporting IMMP MUST respect them for any communication
but ignore them for any (public) display. Default folders such as INBOX, DRAFTS, SENT and JUNK should be excluded from filtering.

Messages are references as `user@host/mailbox#messageid`:

~~~~
  alice@domain.com
  |--INBOX
  :   |-- 619b982c-f9b4-4263-bbc7-755afc7710dd
      |-- 716e9a9e-7a48-4fd0-aa80-a1ac52f13cb2
      :
~~~~

In this example the full URI to the first message would be:

      alice@domain.com/INBOX#619b982c-f9b4-4263-bbc7-755afc7710dd

As messages are identified using UUIDs the same message can exist in several mailbox folders at once.