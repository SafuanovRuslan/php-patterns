<?php

abstract class AbstractDB {
    abstract public function DBConnection() : Connection;
    abstract public function DBRecord() : Record;
    abstract public function DBQueryBuilder() : Query;
}

class MySQL extends AbstractDB {
    public function OracleConnection() : Connection {
        return new MySQLConnection();
    }

    public function OracleRecord() : Record {
        return new MySQLRecord();
    }

    public function OracleQueryBuilder() : Query {
        return new MySQLQuery();
    }
}

class PostgreSQL extends AbstractDB {
    public function OracleConnection() : Connection {
        return new PostgreSQLConnection();
    }

    public function OracleRecord() : Record {
        return new PostgreSQLRecord();
    }

    public function OracleQueryBuilder() : Query {
        return new PostgreSQLQuery();
    }
}

class Oracle extends AbstractDB {
    public function OracleConnection() : Connection {
        return new OracleConnection();
    }

    public function OracleRecord() : Record {
        return new OracleRecord();
    }

    public function OracleQueryBuilder() : Query {
        return new OracleQuery();
    }
}



interface Connection {
    public function connect() : string;
}


class MySQLConnection implements Connection {
    public function connect() : string {
        return 'MySQL database connection was successful';
    }
}

class PostgreSQLConnection implements Connection {
    public function connect() : string {
        return 'PostgreSQL database connection was successful';
    }
}

class OracleConnection implements Connection {
    public function connect() : string {
        return 'Oracle database connection was successful';
    }
}



interface Record {
    public function record() : string;
}


class MySQLRecord implements Record {
    public function record() : string {
        return 'MySQL database recording was successful';
    }
}

class PostgreSQLRecord implements Record {
    public function record() : string {
        return 'PostgreSQL database recording was successful';
    }
}

class OracleRecord implements Record {
    public function record() : string {
        return 'Oracle database recording was successful';
    }
}



interface QueryBuilder {
    public function query() : array;
}


class MySQLQueryBuilder implements QueryBuilder {
    public function query() : array {
        return $MySQLResult;
    }
}

class PostgreSQLQueryBuilder implements QueryBuilder {
    public function query() : array {
        return $PostgreSQLResult;
    }
}

class OracleQueryBuilder implements QueryBuilder {
    public function query() : array {
        return $OracleResult;
    }
}