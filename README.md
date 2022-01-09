Quick fix to avoid paying 5$ a Month for a Websocket.
Stores my IFTTT Requests and allows a (FIFO) GET for my NODE-RED Inject Node. 
Sidenote: PHP SUCKS

Flow: IFTTT catches my Requests by Pattern.
IFTTT POSTs a custom Command to my Micro-API.
My RaspberryPI is setup with NODE-RED and waits for new Commands.

flow.json is the NODE-RED Configuration.

Enables me to Control my Television like a SmartTV via HDMI:CEC
(TV ON/OFF | VIDEO PLAY/PAUSE | INCREASE/DECREASE VOLUME | MUTE/UNMUTE | VOLUME TO 0-100)
