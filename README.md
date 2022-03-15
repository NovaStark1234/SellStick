<div align="center">
<h1>SellStick | v0.0.1<h1>
</div>
<p align="center">
<a href="https://poggit.pmmp.io/p/HelpBook"><img src="https://poggit.pmmp.io/shield.state/SellStick">
</a>
<br>
✔️ Sell all the items in the chest when the player using SellStick clicks on it ✔️
</p>

<br>

## Features
- Sell stick
- When type command '/sellstick', you will be given a sell stick
- Easy to custom in **config.yml**

<br>

## Commands
| **Commands** | **Description** |
| --- | --- |
| **/sellstick** | **Sell Stick** |

<br>

## Permissions
| **Permission** | **Default** |
| --- | --- |
| **sellstick.command.use** | **op** |
	
<br>

## Config
```
---
sellstickname: "§l§aSell §bStick"
sellsticklore: "§r§l§7Usage: Tap the chest to automatically sell all the items in the chest!"
# Format:
#    - "<id(int)>,<meta(int)>:<cost(int|float)>"
sell:
 - "1,0:1" #Stone
 - "4,0:1" #Cobblestone
 
 # Choose the type of economy you want to use ("bedrockeconomy", "economyapi")
 economytype: "bedrockeconomy"
...
```

<br>

## Install
- Step 1: Click the "Direct Download" button to download the plugin
- Step 2: Move the file "SellStick.phar" into the file "plugins"
- Step 3: Restart server for plugins to work
