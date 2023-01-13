# Name: Felipe Lima
# Assessment for Cadence Design Systems 01/11/2023

#Problem
# A certain system needs a password validator module, which upon receiving a string with a password and a list with the requirements 
# of this password, returns whether the password is valid or not. The list of the password requirements is composed of tuples containing 
# the following:
    # • First value:    
        # o LEN – password length
        # o LETTERS – # of letters
        # o NUMBERS – # of numbers
        # o SPECIALS – # of special characters
    # • Second value: <, > or =
    # • Third value: an integer number
# Ex.:
    # req = [('LEN', '=', 8), ('SPECIALS', '>', 1)]
    # req specify a password with eight characters and at least two special characters
# Write a Python 3 script to solve this problem and the unit test to validate it, without installing external packages.

# Find the number of characters in the password that match the specified character type
def find_len(password, char_type):
    if char_type == "LEN":
        return len(password)
    elif char_type == "LETTERS":
        return len([char for char in password if char.isalpha()])
    elif char_type == "NUMBERS":
        return len([char for char in password if char.isdigit()])
    elif char_type == "SPECIALS":
        return len([char for char in password if not (char.isalpha() or char.isnumeric())])


#Validates the password agaisnt the given parameters
def validator(password, reqs):
    for req in reqs:
        char_type, operator, value = req
        if (operator == "="):
            if(find_len(password, char_type) != value):
                return False
        if (operator == "<"):
            if(find_len(password, char_type) >= value):
                return False
        if (operator == ">"):
            if(find_len(password, char_type) <= value):
                return False
    return True

# Prints whether the password id valid or not
def is_valid(password, reqs):
    if validator(password, reqs) == True:
        print("Password is valid")
    else:
        print("Password is not valid")


# Testing the password validator
def test_validator():
    # Test for password length
    reqs = [('LEN', '=', 8)]
    assert validator("password", reqs) == True
    assert validator("p@ssword", reqs) == True
    assert validator("dkslp02h", reqs) == True
    assert validator("12e#$89s", reqs) == True
    assert validator("djkfn43fjk4!", reqs) == False
    assert validator("", reqs) == False
    assert validator("!", reqs) == False

    # Test for # of letters
    reqs = [('LETTERS', '>', 5), ('LETTERS', '<', 15)]
    assert validator("password", reqs) == True
    assert validator("p@ssword", reqs) == True
    assert validator("12345678", reqs) == False
    assert validator("asdf404", reqs) == False
    assert validator("djkfndddddjjdjdjdjdjdjdjdjdjdj43fjk4!", reqs) == False
    assert validator("", reqs) == False
    assert validator("!", reqs) == False

    # Test for # of numbers
    reqs = [('NUMBERS', '>', 5), ('NUMBERS', '<', 15)]
    assert validator("password", reqs) == False
    assert validator("p@ssword", reqs) == False
    assert validator("12345678", reqs) == True
    assert validator("2349asdf404", reqs) == True
    assert validator("sjd0101940fj((!", reqs) == True
    assert validator("12345678901234567890", reqs) == False
    assert validator("!", reqs) == False

    # Test for # of specials
    reqs = [('SPECIALS', '>', 5), ('SPECIALS', '<', 15)]
    assert validator("password", reqs) == False
    assert validator("p@ssword", reqs) == False
    assert validator("12@#$%^!345678", reqs) == True
    assert validator("!!**djdjdjd&*@", reqs) == True
    assert validator("!*!*!", reqs) == False
    assert validator("ahdj******@@@(@(@(@(@(@(@(@@@@@", reqs) == False
    assert validator("!", reqs) == False

    # Test for all
    reqs = [('LEN', '>', 8), ('LETTERS', '>', 4), ('NUMBERS', '=', 3), ('SPECIALS', '=', 1), ]
    assert validator("password", reqs) == False
    assert validator("p@ssword", reqs) == False
    assert validator("passw123!", reqs) == True
    assert validator("pawi!234", reqs) == False
    assert validator("!apelo234", reqs) == True
    assert validator("!apeljdjdfjdjjdfjnefeo234", reqs) == True
    assert validator("", reqs) == False
    assert validator("!", reqs) == False

test_validator()