<?php
class Model {
    private $conn;
    private $table;

    public function __construct($db, $tb) 
    {
        $this->conn = $db;
        $this->table = $tb;
    }

    // Count all records in the table
    public function countRecords($where_clause = 1, $data = [])
    {
        $query = "SELECT COUNT(*) AS total FROM $this->table WHERE $where_clause";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->fetch();
    }

    // Sanitize data coming from users
    public function sanitize($data) 
    {
        $clean_data = [];
        //sanitize post data
        foreach ($data as $key => $value) {
            $clean_data[$key] = htmlspecialchars(stripslashes(strip_tags($value)));    
        }
        return $clean_data;
    }

    // Select all records from the table
    public function readRecords($where_clause = 1, $data = [], $column = "*")
    {
        $query = "SELECT $column FROM $this->table WHERE $where_clause ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->fetchAll();
    }

    // Select a single record from the table
    public function readSingleRecord($where_clause = 1, $data = [], $column = "*")
    {
        $query = "SELECT $column FROM $this->table WHERE $where_clause ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
        return $stmt->fetch();
    }

    // Create a record in the table
    public function create($column, $value, $data = [])
    {
        $query = "INSERT INTO $this->table($column) VALUES ($value) ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Get the last record in the table
    public function getLastId()
    {
        $last_id = $this->conn->lastInsertId();
        return $last_id;
    }

    // Update table record
    public function update($column, $where_clause, $data = [])
    {
        $query = "UPDATE $this->table SET $column WHERE $where_clause ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Delete table record
    public function delete($where_clause, $data = [])
    {
        $query = "DELETE FROM $this->table WHERE $where_clause ";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Send email
    public function mail_user($mail, $data)
    {
        extract($data);
        $recipients = explode(', ', $recipient);
        foreach ($recipients as $addressee) {
            $mail->setFrom('admin@misionschannel.org.ng', 'Monitum Website');
            $mail->addAddress($addressee, 'Monitum Manager');
            $mail->addReplyTo("admin@misionschannel.org.ng");
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = '
                <!DOCTYPE html>
                <html lang="en">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <style>
                html, body {
                        margin: 0px;
                        padding: 0px;
                    }
                    .text-center {
                        text-align: center;
                    }
                    .thm-text {
                        color:  #ff5722;
                    }
                    .bg-dark {
                        background-color:  #000;
                    }
                    .row {
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: center;
                        align-items: center;
                    }
                    .col {
                        display: flex;
                        flex-direction: column;
                        justify-content: center;
                        align-items: center;
                    }
                    img {
                        max-width: 100%;
                    }
                    .container{
                        margin-left: auto;
                        margin-right: auto;
                        padding-left: 1rem;
                        padding-right: 1rem;
                    }
            .link {
                color: blue;
            }
                </style>
                </head>
                <body>
                    <main class="container">
                        <p>A User Sent An Enquiry Through Monitum Website. Please Login To Monitum Website Admin Page So As To Respond. </p>
                        <p>'. $message . '</b>
                        <h4><b>Thanks</b></h4>
                    </main>
                    </body>
                </html>
            ';
            $mail->AltBody = 'A User Sent An Enquiry Message Through Monitum Website. Please Login To Monitum Website Admin Page So As To Respond.';
        
            $mail->isSMTP();
            $mail->Host = 'mail.misionschannel.org.ng';
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = 'ssl';
            $mail->Username = 'admin@misionschannel.org.ng';
            $mail->Password = 'admin@misionschannel.org.ng';
            $mail->Port = 465;
        
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ),
            );
        
            if (!$mail->send()) {
                $msg = 'Mail could not be sent.';
                $msg .= 'Mailer Error: ' . $mail->ErrorInfo;
                $mailsent = 0;
            } else {
                $msg = 'Mail Sent Successfully.';
                $mailsent = 1;
            }
            return ['mailsent' => $mailsent, 'message' => $msg];
        }
    }

}