$folderPath = "C:\Project Data\test1\"  # Replace with the path to your folder containing PDF files

# Load the iTextSharp DLL
Add-Type -Path "C:\Project Data\test1\itextsharp.dll"

# Function to extract text from a PDF file using OCR
function Extract-PdfText {
    Param (
        [string]$PdfFilePath
    )

    # Convert the PDF to an image using Ghostscript
    $imagePath = $PdfFilePath -replace '\.pdf$', '.png'
    $ghostScriptPath = "C:\Program Files (x86)\gs\gs10.01.1\bin\gswin32c.exe"  # Replace with the path to your Ghostscript executable
    & $ghostScriptPath -sDEVICE=png16m -r300 -o $imagePath $PdfFilePath

    # Use Tesseract to perform OCR on the image
    $tesseractPath = "C:\Program Files\Tesseract-OCR\tesseract.exe"  # Replace with the path to your Tesseract executable
    $outputFile = $PdfFilePath -replace '\.pdf$', '.txt'
    & $tesseractPath $imagePath $outputFile -l deu

    # Read the extracted text from the output file
    $extractedText = Get-Content -Raw $outputFile

    # Remove the temporary image and output files
    Remove-Item -Path $imagePath
    Remove-Item -Path $outputFile

    return $extractedText
}

$Source = 'PDF-USB'

$folderPath = "C:\Project Data\test1\"  # Replace with the path to your folder containing text files

# Set connection string parameters
$server = "52.206.30.243"
$database = "egs_db"
$username = "egs.adminps1"
$password = "H9Uiydu883zZGYboZ"

# Create a SQL connection object
$sqlConnection = New-Object System.Data.SqlClient.SqlConnection("Server=$server;Database=$database;User ID=$username;Password=$password;")

$sqlConnection.Open()

# Function to read the content from a text file
function Read-TextFile {
    Param (
        [string]$TextFilePath
    )

    $text = Get-Content -Path $TextFilePath -Raw

    return $text
}

function ConvertTo-UTF8String {
    Param (
        [string]$InputString
    )

    $utf8Encoding = [System.Text.Encoding]::UTF8
    $utf8Bytes = $utf8Encoding.GetBytes($InputString)
    $utf8String = [System.Text.Encoding]::UTF8.GetString($utf8Bytes)

    return $utf8String
}

function Test-Json {
    param (
        [Parameter(Mandatory=$true)]
        [string]$JsonString
    )

    try {
        $null = $JsonString | ConvertFrom-Json
        Write-Output "The JSON structure is valid."
        Return 1
    }
    catch {
        Write-Output "The JSON structure is NOT valid."
        Return 0
    }
}

# Prompt
$prompt = @"
Please get all the data from the content below. Do not remove any data in the ingredients section. Include also what is between parenthesis and the percentage. Do not put any temperature in the storage temperature if the temperature is above 20°C and return the values using this JSON format:
{
  "technical_sheet": {
    "product_name": "",
    "product_id": "",
    "brand": "",
    "packaging": "",
    "quality": "",
    "composition": ["", ""],
    "ingredients": ["ingredient1", "ingredient2"],
    "co2": "",
    "origin": "",
    "shelf_life_minimum_guaranteed": "",
    "storage_temperature": "",
    "manufacturer_name": "",
    "manufacturer_address": "",
    "manufacturer_gencod": "",
    "manufacturer_dun14": "",
    "gtin": "",
    "storage_information": "",
    "nutritional_information_per_100g": {
      "energy_in_kJ": "",
      "energy_in_kcal": "",
      "fat": "",
      "saturated_fat": "",
      "carbohydrate": "",
      "sugar": "",
      "protein": "",
      "salt": "",
      "fiber": "",
      "sodium": "",
      "calcium": "",
      "transfat": "",
      "alcohol": "",
      "water": ""
    },
    "allergens": {
      "Gluten_yes_or_no_or_unknown": "",
      "Wheat_yes_or_no_or_unknown": "",
      "Rye_yes_or_no_or_unknown": "",
      "Barley_yes_or_no_or_unknown": "",
      "Spelt_yes_or_no_or_unknown": "",
      "Oats_yes_or_no_or_unknown": "",
      "Kamut_yes_or_no_or_unknown": "",
      "Milk_yes_or_no_or_unknown": "",
      "Lactose_yes_or_no_or_unknown": "",
      "Egg_yes_or_no_or_unknown": "",
      "Fish_yes_or_no_or_unknown": "",
      "Crustacean_yes_or_no_or_unknown": "",
      "Soybean_yes_or_no_or_unknown": "",
      "Peanut_yes_or_no_or_unknown": "",
      "Nuts_yes_or_no_or_unknown": "",
      "Almond_yes_or_no_or_unknown": "",
      "Hazelnut_yes_or_no_or_unknown": "",
      "Walnut_yes_or_no_or_unknown": "",
      "Pistachio_yes_or_no_or_unknown": "",
      "PecanNut_yes_or_no_or_unknown": "",
      "CashewNut_yes_or_no_or_unknown": "",
      "BrazilNut_yes_or_no_or_unknown": "",
      "Macadamia_yes_or_no_or_unknown": "",
      "PineNut_yes_or_no_or_unknown": "",
      "Celery_yes_or_no_or_unknown": "",
      "Mustard_yes_or_no_or_unknown": "",
      "Sesame_yes_or_no_or_unknown": "",
      "Sulfite_yes_or_no_or_unknown": "",
      "Lupine_yes_or_no_or_unknown": "",
      "Molluscs_yes_or_no_or_unknown": ""
    }
  }
}
"@

# Function to check if the text file already exists in the EgsChatGpt table
function Is-TextFileExistsInTable {
    Param (
        [string]$TextFileName
    )

    $sql = "SELECT ID FROM EgsChatGpt WHERE Reference = '$TextFileName'"
    $command = New-Object System.Data.SqlClient.SqlCommand($sql, $sqlConnection)
    $command.CommandTimeout = 65000
    $reader = $command.ExecuteReader()
    $exists = $reader.HasRows
    $reader.Close()

    return $exists
}

# Get PDF files
$pdfFiles = Get-ChildItem -Path $folderPath -Filter *.pdf -Recurse

foreach ($pdfFile in $pdfFiles) {
    Write-Host "Processing file: $($pdfFile.FullName)"
    
    $pdfPath = $pdfFile.FullName
    
    try {
        $pdfContent = Extract-PdfText -PdfFilePath $pdfPath

        if ([string]::IsNullOrWhiteSpace($pdfContent)) {
            Write-Host "Error: No content extracted from the PDF file."
        }
        else {
            Write-Host "Extracted content:"
            Write-Host $pdfContent

            # Save the extracted content in a text file
            $textFileName = [System.IO.Path]::ChangeExtension($pdfFile.Name, ".txt")
            $textFilePath = Join-Path -Path $folderPath -ChildPath $textFileName
            $pdfContent | Out-File -FilePath $textFilePath -Encoding UTF8

            # Check if the text file already exists in the EgsChatGpt table
            if (Is-TextFileExistsInTable -TextFileName $textFileName) {
                # If the file name is already in the table, display a message
                Write-Host "Error: $textFileName is already in EgsChatGpt table."
            }
            else {
                # Process the text content
                $AskChatGPT = $prompt + $pdfContent

                # Save in Table EgsChatGPT
                $AskChatGPT = $AskChatGPT.Replace("'", "''")

                $sql = "INSERT INTO EgsChatGPT (Question, Priority, Source, Reference, FolderName) VALUES ('$AskChatGPT', 1,'$Source','$textFileName','$subfolderName')"
                $command = New-Object System.Data.SqlClient.SqlCommand($sql, $sqlConnection)
                $command.CommandTimeout = 65000
                [void]$command.ExecuteNonQuery()
            }
        }
    }
    catch {
        $errorMessage = $_.Exception.Message
        Write-Host "Error extracting content from the PDF file: $errorMessage"
    }
}

# Close database connection
if ($sqlConnection -ne $null) {
    $sqlConnection.Close()
}