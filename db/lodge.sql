CREATE DATABASE lodge;

USE lodge;

-- step 1
CREATE TABLE userType (
    userTypeId INT AUTO_INCREMENT PRIMARY KEY,
    userType VARCHAR(20) NOT NULL
);

-- step 2
CREATE TABLE users (
userId INT AUTO_INCREMENT PRIMARY KEY,
fName VARCHAR (255),
lName VARCHAR (255),
address VARCHAR (255),
email VARCHAR (255),
phoneNumber VARCHAR(50),
userTypeId INT,
FOREIGN KEY (userTypeId) REFERENCES UserType(userTypeId)
);

-- step 8
CREATE TABLE rooms (
roomId INT PRIMARY KEY,
roomRate INT,
roomNumber INT,
roomStatus BOOLEAN,
FOREIGN KEY (roomRate) REFERENCES rates(roomRate), 
FOREIGN KEY (roomStatus) REFERENCES housekeeping(roomStatus),
FOREIGN KEY (roomNumber) REFERENCES roomType(roomNumber)
);

-- step 3
CREATE TABLE roomType (
roomNumber INT AUTO_INCREMENT PRIMARY KEY,
roomType VARCHAR (255),
roomCapacity INT,
petsAllowed BOOLEAN
);

-- step 4
CREATE TABLE rates (
roomRate INT PRIMARY KEY,
promoRate DECIMAL,
promoTitle VARCHAR(255)
);

-- step 9
CREATE TABLE reservations (
reservationId INT AUTO_INCREMENT PRIMARY KEY,
userId INT,
roomId INT,
checkIn DATE,
checkOut DATE,
numberOfGuests INT,
specialNeeds VARCHAR(255),
FOREIGN KEY (userId) REFERENCES users(userId),
FOREIGN KEY (roomId) REFERENCES rooms(roomId)
);

-- step 10
CREATE TABLE roomKeys (
keyId INT PRIMARY KEY,
roomId INT,
reservationId INT,
keyStatus SET('checkedOut', 'returned', 'lost', 'stolen'),
FOREIGN KEY (roomId) REFERENCES rooms(roomId),
FOREIGN KEY (reservationId) REFERENCES reservations(reservationId)
);

-- step 11
CREATE TABLE billing (
invoiceNumber INT AUTO_INCREMENT PRIMARY KEY,
reservationId INT,
roomId INT,
FOREIGN KEY (roomId) REFERENCES rooms(roomId),
FOREIGN KEY (reservationId) REFERENCES reservations(reservationId)
);

-- step 7
CREATE TABLE housekeeping (
roomStatus BOOLEAN PRIMARY KEY,
reservationId INT,
employeeId INT,
productID INT,
FOREIGN KEY (employeeId) REFERENCES employees(employeeId),
FOREIGN KEY (productId) REFERENCES inventory(productId)
);

-- step 5
CREATE TABLE inventory (
productId INT PRIMARY KEY,
productName VARCHAR (255),
stock INT,
stockStatus SET('0','needToOrder','low','good')
);

-- step 12
CREATE TABLE breakfast (
breakfastId INT AUTO_INCREMENT PRIMARY KEY,
productId INT,
FOREIGN KEY (productId) REFERENCES inventory(productId)
);

-- step 13
CREATE TABLE events (
 eventId INT AUTO_INCREMENT PRIMARY KEY,
  eventName VARCHAR(255),
  eventType VARCHAR(255),
  eventDate DATE,
  description TEXT
);

-- step 14
CREATE TABLE eventBookings (
  bookingId INT AUTO_INCREMENT PRIMARY KEY,
  eventId INT,
  userId INT,
  bookingDate DATE,
  FOREIGN KEY (eventId) REFERENCES events(eventId),
  FOREIGN KEY (userId) REFERENCES users(userId)
);

-- step 15
CREATE TABLE sauna (
saunaSessionId INT AUTO_INCREMENT PRIMARY KEY,
roomNumber INT,
availability BOOLEAN,
FOREIGN KEY (roomNumber) REFERENCES roomType(roomNumber)
);

-- step 6
CREATE TABLE employees (
employeeId INT AUTO_INCREMENT PRIMARY KEY,
fName VARCHAR (255),
lName VARCHAR (255),
jobTitle VARCHAR (255)
);

-- step 16
CREATE TABLE jobRecord (
jobId INT AUTO_INCREMENT PRIMARY KEY,
jobTitle VARCHAR(255),
available BOOLEAN
);

-- step 17
CREATE TABLE payRoll (
payrollId INT AUTO_INCREMENT PRIMARY KEY,
employeeId INT,
salary DECIMAL(10, 2),
paymentDate DATE,
FOREIGN KEY (employeeId) REFERENCES employees(employeeId)
);

-- step 18
CREATE TABLE schedule (
scheduleId INT AUTO_INCREMENT PRIMARY KEY,
employeeId INT,
roomId INT,
startTime DATETIME,
endTime DATETIME,
dayOfWeek SET('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
FOREIGN KEY (employeeId) REFERENCES employees(employeeId),
FOREIGN KEY (roomId) REFERENCES rooms(roomId)
);

-- step 19
CREATE TABLE frontDesk (
frontDeskId INT AUTO_INCREMENT PRIMARY KEY,
employeeId INT,
FOREIGN KEY (employeeId) REFERENCES employees(employeeId)
);









